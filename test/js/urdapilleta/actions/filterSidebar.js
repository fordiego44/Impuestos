import SidebarFilter from "../user-interface/SidebarFilter";

//@todo Create Sidebar Checkbox Filter

export const sidebarFilter = (result) => {

    if (result['property_types']) {
        let propertyTypes = new SidebarFilter('propertyType', 'Tipo de Propiedad', result.property_types)
        propertyTypes.appentToElement('p_type-card')
    }

    if (result['operation_types']) {
        let propertyTypes = new SidebarFilter('operationType', 'Tipo de Operacion', result.operation_types)
        propertyTypes.appentToElement('p_operation-card')
    }

    if (result['room_amount']) {
        let propertyTypes = new SidebarFilter('room', 'Ambientes', result.room_amount)
        propertyTypes.appentToElement('p_amb-card')
    }

    if (result['suite_amount']) {
        let propertyTypes = new SidebarFilter('suite', 'Dormitorios', result.suite_amount)
        propertyTypes.appentToElement('p_dorm-card')
    }

}
