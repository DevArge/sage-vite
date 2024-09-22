export default class ExampleAjax{

    ensureTrailingSlash(url) {
        if (!url.endsWith('/')) {
            url += '/';
        }
        return url;
    }

    hello(){

        let url = document.querySelector('meta[name=base]').getAttribute('content')

        // // Get admin-ajax.php URL
        const ajaxURL: string = this.ensureTrailingSlash(url) + "wp-admin/admin-ajax.php";
        // create the params
        const params = new URLSearchParams({
            action: 'example_ajax_func',
            name: 'Homer',
        });
        // fetch the data
        fetch(ajaxURL, {
            method: 'POST',
            body: params
        }).then(res => res.json())
            .catch(error => {
                console.log(error);
            })
            .then(response => {
                console.log(response);
            })
    }
}
