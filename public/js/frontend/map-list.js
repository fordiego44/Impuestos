const actionMap = {
    async list() {
        let { data: data } = await axios.get('list-restaurant');
        const html = this.userHTML(data)
        $('#listRestaurant').empty().append(html);

    },
    userHTML(data) {
        let html = [];
        for (var i = 0; i < data.length; i++) {
            html[i] = `<div class="col-lg-12 col-md-12">
                <a href="/restaurant/${slug}" class="listing-item-container" data-marker-id="2">
                    <div class="listing-item">
                        <img src="images/${data.image}" alt="">
                        <div class="listing-item-details">
                            <ul>
                                <li>Friday, August 10</li>
                            </ul>
                        </div>
                        <div class="listing-item-content">
                            <span class="tag">Events</span>
                            <h3>${$data.company}</h3>
                            <span>Bishop Avenue, New York</span>
                        </div>
                        <span class="like-icon"></span>
                    </div>
                    <div class="star-rating" data-rating="5.0">
                        <div class="rating-counter">(23 reviews)</div>
                    <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span></div>
                </a>
            </div>`
        }
        return html;
    },
}

actionMap.list()