import { resolve } from 'path';
import { rm } from 'fs';
import pluginManifest from 'rollup-plugin-output-manifest'
import devManifest from 'vite-plugin-dev-manifest';
import liveReload from 'vite-plugin-live-reload'
import { defineConfig, loadEnv } from 'vite'
import laravel from 'laravel-vite-plugin';
import TailwindCSS from 'tailwindcss'
import Autoprefixer from 'autoprefixer'

const { default: outputManifest } = pluginManifest

export default defineConfig(async ({ mode }) => {
  const isDev = mode === 'development'
  const devServerConfig = loadEnv(mode, process.cwd(), 'HMR')


  if (!isDev) {
      await cleanup()
      await cleanupDevManifest()
  }

  return {
    plugins: [
      devManifest(),
      liveReload(resolve(__dirname, 'resources/views/**/*.php')),
      laravel({
        input: [
          'resources/styles/app.css',
          'resources/scripts/app.ts',
        ],
        refresh: true,
      }),
      {
        apply: 'build',
        transformIndexHtml: html => minify(html, {
            collapseWhitespace: true,
            removeComments: true,
        })
      },
    ],
    css:{
      preprocessorOptions: {
        scss: {
            additionalData: `@import 'tailwindcss/base'; @import 'tailwindcss/components'; @import 'tailwindcss/utilities';`
        }
      },
      postcss: {
          plugins: [
              TailwindCSS,
              Autoprefixer,
          ],
      },
    },
    resolve: {
      alias: {
        '@': resolve(__dirname, 'resources'),
        '@styles': resolve(__dirname, 'resources/styles'),
        '@scripts': resolve(__dirname, 'resources/scripts'),
        '@images': resolve(__dirname, 'resources/images'),
        '@fonts': resolve(__dirname, 'resources/fonts'),
      },
    },

    base: "./",
    // publicDir: './',

    build: {
      manifest: isDev,
      assetsDir: 'images',
      emptyOutDir: false,
      outDir: resolve(__dirname, 'public'),
      // assetsInlineLimit: 0,
      rollupOptions: {
        input: {
          app: resolve(__dirname, 'resources/scripts/app.ts'),
          editor: resolve(__dirname, 'resources/scripts/editor.ts'),
        },
        output: {
          chunkFileNames: 'chunks/[name].[hash].js',
          entryFileNames: '[name].[hash].js',

          assetFileNames: ({name}) => {
            if (/\.(png|jpe?g|gif|svg|ico|webp)$/i.test(name)) {
              return `images/[name].[hash][extname]`;
            }

            if (/\.(woff|woff2|eot|ttf|otf)$/i.test(name)) {
              return `fonts/[name].[hash][extname]`;
            }

            return `[name].[hash][extname]`;
          },
        },
        plugins: [
          outputManifest({
            fileName: 'manifest.json',
            generate: (KeyValueDecorator, seed, opt) => chunks =>
              chunks.reduce((manifest, { name, fileName }) => {
                // remove any extension except .js
                const cleanedName = name.replace(/(?<=.)\.(?!js)[^.]+$/, '')

                return name ? {
                  ...manifest,
                  ...KeyValueDecorator(cleanedName, fileName, opt)
                } : manifest
            }, seed)
          }),

          outputManifest({
            fileName: 'entrypoints.json',
            nameWithExt: true,
            filter: bundle => {
              const { fileName } = bundle
              return fileName.endsWith('.js') || fileName.endsWith('.css')
            },
            generate: seed => chunks =>
              chunks.reduce((manifest, { name, fileName }) => {
                const result = {}
                const cleanedName = name.replace(/.css$/, '')

                const js = manifest[cleanedName]?.js || []
                const css = manifest[cleanedName]?.css || []
                const dependencies = manifest[cleanedName]?.dependencies || []

                const entry = { js, css, dependencies }

                fileName.endsWith('.js') && js.push(fileName)
                fileName.endsWith('.css') && css.push(fileName)

                result[cleanedName] = entry

                return {
                    ...manifest,
                    ...result
                }
            }, seed)
          }),
        ]
      },
      minify: true,
      write: true,
    },

    server: {
      host: devServerConfig.HMR_HOST ? devServerConfig.HMR_HOST : 'localhost',
      port: devServerConfig.HMR_PORT ? parseInt(devServerConfig.HMR_PORT) : 5143,
      https: false,
      strictPort: true,
      origin: devServerConfig.HMR_ENTRYPOINT,
      fs: {
        strict: false,
        allow: [
          // 'node_modules',
          // 'resources',
            './public'
        ]
      },
      hmr: {
        host: 'localhost',
      },
      watch: {
        usePolling: true,
        interval: 1000,
      },
    },
  }
})

async function cleanup() {
  rm('public', { recursive: true }, (err) => console.log(`➜ Cleanup public dir: success!`))
}

async function cleanupDevManifest(){
    rm('public/manifest.dev.json', { recursive: true }, (err) => console.log(`➜ Cleanup manifest.dev.json: success!`))

}

