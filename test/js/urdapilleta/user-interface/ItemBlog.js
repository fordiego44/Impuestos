import {BaseElement} from './BaseElement'

export default class ItemBlog extends BaseElement {
    constructor(id, title, data) {
        super()
        this._id = id
        this.title = title
        this.data = data

    }

    createItem(blog) {
        const detailBlogHref = '/blog';
        const categoryBlogHref = '/blog/categoria';
        const tagBlogHref = '/blog/tema';
        let tags = '';
        blog.tags.map(tag => tags +=`<a style="background-color:red;"
                                                   href="${tagBlogHref}/${tag.slug}"
                                                   rel="category tag">${tag.name}</a>`)

        return `<div class="row blog-big-cards">

                            <!-- Post -->
                            <div class="col-md-12 post">

                                <div class="casaroyal-search-card">

                                    <div class="casaroyal-search-card-image casaroyal-post-card-image">

                                        <a href="${detailBlogHref}/${blog.slug}">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <div class="mask"></div>
                                            <img src="/uploads/news/${blog.photo}"
                                                 alt="13 Tips And Tricks For Selling Homes">
                                        </a>

                                    </div>

                                    <div class="casaroyal-search-card-body blog-card-body">

                                        <div class="casaroyal-categories-post">
                                            <a href="${categoryBlogHref}/${blog.category.slug}"
                                               rel="category tag">${blog.category.name}</a>
                                            <!-- nombre de la categoria -->
                                            ${tags}
                                        </div>

                                        <h2>
                                            <a href="${detailBlogHref}/${blog.slug}">${blog.title}</a>
                                        </h2>

                                        <p class="post-preview">${blog.body.substr(0,150)}</p>
                                        <!-- primeros 150 caracteres -->

                                    </div>

                                </div>

                            </div>
                            <!-- Post -->

                        </div>`


    }

    getElementString() {
        let itemList = ''
        for (let data of this.data) {
            itemList += this.createItem(data);
        }
        return itemList;
    }
}
