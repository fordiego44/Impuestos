import { appendQuery, getParams, removeQuery } from './UrlQuery'
import SidebarFilter from "../user-interface/SidebarFilter";

export default class CheckboxFilter {

    constructor(data) {
        this.data = data;
    }

    checkedByUrl(data = getParams()) {

        const { sublocation, tipo_propiedad, tipo_operacion, ambientes, dormitorios, location, surface_type, surface_to, surface_from, price_to, price_from, price_type } = data;

        // if (sublocation) {
        //     sublocation.split(',').map((val) => {
        //         const sub = document.querySelector(`.sublocation-checkbox[value="${val}"]`);
        //         if (sub) sub.checked = true;
        //     })
        // }
        // if (location) {
        //     location.split(',').map((val) => {
        //         const sub = document.querySelector(`.location-checkbox[value="${val}"]`);
        //         if (sub) sub.checked = true;
        //     })
        // }

        if (tipo_propiedad) {
            tipo_propiedad.split(',').map((val) => {

                const property = document.querySelector(`.propertyType-checkbox[value="${val}"]`)
                if (property) property.checked = true;

            })
        }
        if (tipo_operacion) {
            tipo_operacion.split(',').map((val) => {
                const operation = document.querySelector(`.operationType-checkbox[value="${val}"]`)
                if (operation) operation.checked = true;
            })
        }
        if (ambientes) {
            ambientes.split(',').map((val) => {
                const env = document.querySelector(`.room-checkbox[value="${val}"]`)
                if (env) env.checked = true;
            })
        }
        if (dormitorios) {
            dormitorios.split(',').map((val) => {
                const rooms = document.querySelector(`.suite-checkbox[value="${val}"]`)
                if (rooms) rooms.checked = true;
            })
        }
        // if (surface_type) {
        //     const surfaceType = document.querySelector(`[name="surface_type"]`)
        //     if (surfaceType) surfaceType.value = surface_type;
        // }
        // if (surface_to) {
        //     const surfaceTo = document.querySelector(`[name="surface_to"]`)
        //     if (surfaceTo) surfaceTo.value = surface_to;
        // }
        // if (surface_from) {
        //     const surfaceFrom = document.querySelector(`[name="surface_from"]`)
        //     if (surfaceFrom) surfaceFrom.value = surface_from;
        // }
        // if (price_type) {
        //     const priceType = document.querySelector(`[name="currency_type"]`)
        //     if (priceType) priceType.value = price_type;
        // }
        // if (price_from) {
        //     const priceTo = document.querySelector(`[name="currency_from"]`)
        //     if (priceTo) priceTo.value = price_from;
        // }
        // if (price_to) {
        //     const priceFrom = document.querySelector(`[name="currency_to"]`)
        //     if (priceFrom) priceFrom.value = price_to;
        // }

    }

}
