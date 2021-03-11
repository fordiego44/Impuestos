export let pretierSummaryJSON = (dataSummary) => {
    let data = JSON.parse(dataSummary)

    let dataPretty = {}
    let property_types = data['property_types'].map((type) => {
        type.name = type.type
        delete type.type
        return type;
    })
    let operation_types = data.operation_types.map((operation) => {
        switch (operation.operation_type) {
            case 1: {
                operation.id = 1
                operation.name = 'Compra'
                break
            }
            case 2: {
                operation.id = 2
                operation.name = 'Alquiler'
                break
            }
            case 3: {
                operation.id = 3
                operation.name = 'Alquiler Temporal'
                break
            }
                delete operation_type.operation_type
        }
        return operation
    })

    let suite_amount = data.suite_amount.filter((suite) => {
        if(suite.amount < 5){
            suite.name = `${suite.amount} dormitorios`
            suite.id = suite.amount
            delete suite.amount;
            return suite;
        }else if(suite.amount === 5){
            suite.name = `+5 dormitorios`
            suite.id = '+5'
            delete suite.amount;
            return suite;
        }else {
            return false;
        }
    })
    let room_amount = data.room_amount.filter((room) => {
        if(room.amount < 5){
            room.name = `${room.amount} ambientes`
            room.id = room.amount
            delete room.amount;
            return room;
        }else if(room.amount === 5){
            room.name = `+5 ambientes`
            room.id = '+5'
            delete room.amount;
            return room;
        }else {
            return false;
        }

    })
    let bathroom_amount = data.bathroom_amount.map((bathroom) => {
        bathroom.name = `${bathroom.amount} banios`
        bathroom.id = bathroom.amount
        delete bathroom.amount;
        return bathroom;
    })
    let sublocations = data.sublocations.map((sublocation) => {
        sublocation.name = sublocation.location_name
        sublocation.id = sublocation.location_id
        delete sublocation.location_name,sublocation.location_id;
        return sublocation;
    })
    let locations = data.locations
    locations.push({
        id: '25621',
        name: 'Countries/B.Cerrado'
    })
    locations = locations.sort((a,b) => {
        if (a.name < b.name)
            return -1;
        if (a.name > b.name)
            return 1;
        return 0;
    });

    let age = data.age.map((age) => {
        age.name = age.title
        age.id = age.amount
        delete age.title,age.amount;
        return age;
    })
    Object.assign(dataPretty, {
        property_types,
        operation_types,
        suite_amount,
        room_amount,
        bathroom_amount,
        sublocations,
        age,
        locations
    })

    return dataPretty

}
