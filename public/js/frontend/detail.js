

$('#category').on('change', function () {

    let data = $('#category').val();
    console.log(data);
    //$('#content').empty();
    if (data == '01') {
        $('#content').empty();
        list();
    }
    else {
        $.get('/search', { data: data }, function (res) {
            //console.log(res);
            $('#content').empty();
            $.each(res.category, function (index, value) {

                $('#content').append(`
    
                                <div class="col-lg-12 col-md-12">
                                    <div class="listing-item-container list-layout">
                                        <a href="/restaurant/${value.slug}/${value.product_id}" class="listing-item">
                                            
                                            <!-- Image -->
                                            <div class="listing-item-image">
                                                <img src="/images/${value.image}" alt="">
                                                <span class="tag">${value.category_name}</span>
                                            </div>
                                            
                                            <!-- Content -->
                                            <div class="listing-item-content">
    
                                                <div class="listing-item-inner">
                                                <h3>${value.product_name}</h3>
                                                <span>Precio: S/. ${value.price}</span>
                                                    <div >
                                                        <div class="rating-counter">${value.description}</div>
                                                    </div>
                                                </div>
    
                                                <span class="like-icon"></span>
    
                                                <div class="listing-item-details">¡Dale clic si quieres ver los detalles!</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                `

                );
            });
        })
    }



})
$('#search').on('click', function () {

    let word = $('#word').val();
    let user = $('#usuario').val();

    if ($.trim(word) != '') {

        console.log('admitido');
        $.get('/word', { word: word, user: user }, function (res) {
            $('#content').empty();
            $.each(res.data, function (index, value) {

                $('#content').append(`

                                <div class="col-lg-12 col-md-12">
                                    <div class="listing-item-container list-layout">
                                        <a href="/restaurant/${value.slug}/${value.product_id}" class="listing-item">
                                            
                                            <!-- Image -->
                                            <div class="listing-item-image">
                                                <img src="/images/${value.image}" alt="">
                                                <span class="tag">${value.category_name}</span>
                                            </div>
                                            
                                            <!-- Content -->
                                            <div class="listing-item-content">

                                                <div class="listing-item-inner">
                                                <h3>${value.product_name}</h3>
                                                <span>Precio: S/. ${value.price}</span>
                                                    <div >
                                                        <div class="rating-counter">${value.description}</div>
                                                    </div>
                                                </div>

                                                <span class="like-icon"></span>

                                                <div class="listing-item-details">¡Dale clic si quieres ver los detalles!</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                `

                );
            });

        })
    }
    else {
        console.log('inadmitido')
    }


})

function list() {
    let usuario = $('#usuario').val();
    $.get('/list', { data: usuario }, function (res) {

        console.log(res);
        //$('#content').empty();
        $.each(res.list, function (index, value) {

            $('#content').append(`
    
                                    <div class="col-lg-12 col-md-12">
                                        <div class="listing-item-container list-layout">
                                            <a href="/restaurant/${value.slug}/${value.product_id}" class="listing-item">
                                                
                                                <!-- Image -->
                                                <div class="listing-item-image">
                                                    <img src="/images/${value.image}" alt="">
                                                    <span class="tag">${value.category_name}</span>
                                                </div>
                                                
                                                <!-- Content -->
                                                <div class="listing-item-content">
    
                                                    <div class="listing-item-inner">
                                                    <h3>${value.product_name}</h3>
                                                    <span>Precio: S/. ${value.price}</span>
                                                        <div >
                                                            <div class="rating-counter">${value.description}</div>
                                                        </div>
                                                    </div>
    
                                                    <span class="like-icon"></span>
    
                                                    <div class="listing-item-details">¡Dale clic si quieres ver los detalles!</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                    `

            );
        });

    })

}


