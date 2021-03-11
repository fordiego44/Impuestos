import request from '../services/request'

const HOST = `${location.protocol}//${location.host}`;

const url = {

    url: `${HOST}/api${document.location.pathname}${document.location.search}`,

}

export let findBlog = (options = url) => {

    return request(options).then(data => data = JSON.parse(data))

}
