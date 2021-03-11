export default class ValidateForm {

    constructor(prop) {
        if (typeof prop.fields === 'object') {
            this.fields = prop.fields;
            this.fields.map((item) => {
                const elementValidate = document.querySelector(`[name="${item.name}"]`)
                if (elementValidate) {
                    elementValidate.dataset.validate = item.name;
                }
            })
        } else {
            throw new Error('Las opciones deberian ser un objeto de reglas');
        }

    }

    validate(elem, getValue = false, message = false) {

        if (typeof elem !== 'string') {
            throw new Error('Deberia ser un string');
        }
        const elementValidate = document.querySelector(`[name="${elem}"]`)
        if (elementValidate === null) {
            throw new Error(`Elemento en dataset no encontrado ${elem}`);
        }
        const { value } = elementValidate;
        const fieldValidateData = this.fields.filter((val) => val.name === elem);

        if (fieldValidateData.length === 0) {
            throw new Error(`Regla para ${elem} no ha sido encontrado`);
        }

        if (message === true) {

            const elementValidateMessage = document.querySelector(`#form-${elem}-message`);

            if (elementValidateMessage !== null) {
                elementValidateMessage.parentElement.removeChild(elementValidateMessage);
            }
            //
            const regex = new RegExp(fieldValidateData[0].rule, 'gi');
            const div = document.createElement('div')
            //     // <label for="name" class="error">* Please provide your name</label>
            if (regex.test(value)) {

                div.setAttribute('id', `form-${elem}-message`);
                div.classList.add('text-success');
                div.textContent = fieldValidateData[0].message.success || `Campo correctamente completado`;
                elementValidate.parentElement.appendChild(div);


                // elementValidate.parentNode.parentNode.insertBefore(div, elementValidate.parentElement.parentElement.nextSibling);
                // elementValidate.parentElement.parentElement.appendChild(div);
                // if(getValue === true){
                //     return value;
                // }else{
                //     return true;
                // }
            } else {

                div.setAttribute('id', `form-${elem}-message`);
                div.classList.add('text-danger');
                div.textContent = fieldValidateData[0].message.error || `Complete correctamente el campo`;
                elementValidate.parentElement.appendChild(div);

                // referenceNode.parentNode.insertBefore(div, referenceNode.nextSibling);
                // return false;
            }

        }
        return (getValue === true) ? value : false;
        // const elementValidateMessage = document.querySelector(`#form-${elem}-message`);
        //
        // if (elementValidateMessage !== null) {
        //     elementValidateMessage.parentElement.removeChild(elementValidateMessage);
        // }
        //
        // const regex = new RegExp(fieldValidateData[0].rule, 'gi');
        // const div = document.createElement('div')
        //     // <label for="name" class="error">* Please provide your name</label>
        // if (regex.test(value)) {
        //
        //     div.setAttribute('id', `form-${elem}-message`);
        //     div.classList.add('text-success');
        //     div.textContent = fieldValidateData[0].message.success || `Campo correctamente completado`;
        //     elementValidate.parentElement.appendChild(div);
        //     if(getValue === true){
        //         return value;
        //     }else{
        //         return true;
        //     }
        // } else {
        //
        //     div.setAttribute('id', `form-${elem}-message`);
        //     div.classList.add('text-danger');
        //     div.textContent = fieldValidateData[0].message.error || `Complete correctamente el campo`;
        //     elementValidate.parentElement.appendChild(div);
        //     return false;
        // }

    }

    validateFormAll(message = false) {
        let formValidate = true;
        let dataForm = {};
        console.log(formValidate);

        this.fields.map((item) => {
            console.log(item);

            const v = this.validate(item.name, true, message);
            console.log(v);

            dataForm[item.name] = v;
            if (!v) formValidate = false;

        })

        if (formValidate) {
            return dataForm;
        } else {
            return false;
        }
    }


}
