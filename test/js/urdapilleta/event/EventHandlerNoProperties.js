
export default class EventHandler {
    constructor(elem) {
        this._element = elem;
        elem.onclick = this.onClick.bind(this)

    }

    onClick(e) {

        let { action } = e.target.dataset
        let form = document.getElementById("property-not-form").elements;
        //const valProperty = document.getElementById('property_id').value;
        let data = {
            name: form[0].value,
            cellphone: form[1].value,
            email: form[2].value,
            properties: [document.location.pathname.split('/buscar/')[1]],
            slug: document.location.pathname.split('/buscar/')[1],
            tags: ['urdapilleta.com.ar'],
        }

        //console.log(data);
        if (data) {
            jQuery.ajax({
                method: "POST",
                url: "/contactos",
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function (e) {
                    let r = document.getElementById('property-list-form')
                    r.innerHTML = '<div class="alert alert-success" role="alert">\n' +
                        '  <h4 class="alert-heading">Genial!</h4>\n' +
                        '  <p>Tu consulta ha sido enviada te responderemos a la brevedad.</p>\n' +
                        '  <hr>\n' +
                        '</div>';
                },
                error: function (e) {

                    console.log(e);
                }
            })
        }

    }


}
