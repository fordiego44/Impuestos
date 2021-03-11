export let appendQuery = (key, value) => {
    if (typeof value === 'undefined') return;
    const baseUrl = `${location.protocol}//${location.host}${location.pathname}`;
    const urlQueryString = document.location.search;
    let newParam = key + '=' + encodeURIComponent(value),
        params = '?' + newParam;
    if (urlQueryString) {
        const keyRegex = new RegExp('([\?&])' + key + '[^&]*', 'gi');
        // const keyValueQueryRegex = new RegExp(`(?<=${key}=)([\\d|,]+)[^&]*`, 'gi');
        const keyValueQueryRegex = new RegExp(`${key}=([\\d|,]+)[^&]*`, 'gi');
        const regexSolveKeyValue = urlQueryString.match(keyValueQueryRegex);
        const queryStringMatch = (regexSolveKeyValue != null) ? regexSolveKeyValue[0].split('=')[1] : null;
        if (queryStringMatch !== null) {
            let valuesQuery = `${queryStringMatch},${encodeURIComponent(value)}`.split(',').sort((a, b) => {
                return a - b
            }).join(',');
            newParam = `${key}=${valuesQuery}`;
            params = urlQueryString.replace(keyRegex, '$1' + newParam);
        } else {
            if ('&' === urlQueryString[urlQueryString.length - 1]) {
                params = urlQueryString + newParam;
            } else {
                params = urlQueryString + '&' + newParam;
            }
        }
    }
    // params = params.replace(/&{2,}/, '&');

    // window.history.replaceState({}, '', baseUrl + params);



    return false;
};

export let removeQuery = (key, value) => {
    const baseUrl = `${location.protocol}//${location.host}${location.pathname}`;
    const urlQueryString = document.location.search;
    let params = urlQueryString;

    if (urlQueryString) {
        // const keyValueQueryRegex = new RegExp(`(?<=${key}=)([\\d|,|%2B|\\w]+)[^&]*`, 'gi');
        const keyValueQueryRegex = new RegExp(`${key}=([\\d|,|%2B|\\w]+)[^&]*`, 'gi');
        const keyRegex = new RegExp(key + '=' + '[\\d|,|%2B|\\w]*', 'gi');
        const regexResolveKeyValue = urlQueryString.match(keyValueQueryRegex);
        const queryStringMatch = (regexResolveKeyValue != null) ? regexResolveKeyValue[0].split('=')[1] : null;
        if (typeof value === 'undefined') {
            if (urlQueryString.match(keyRegex) !== null) {
                params = urlQueryString.replace(keyRegex, '');
            }
        } else {

            if (queryStringMatch !== null) {
                const valueQuery = queryStringMatch.split(',').filter((val) => {
                    return val !== value;
                }).join(',');
                const replaceValueQuery = (valueQuery === '') ? '' : `${key}=${valueQuery}`;
                params = urlQueryString.replace(keyRegex, replaceValueQuery);
                if (params[params.length - 1] === '&') {
                    params = params.substring(0, params.length - 1);
                }
            }else{

            }
        }
    }
    params = params.replace(/&{2,}/, '&');
    window.history.replaceState({}, '', baseUrl + params);
    return false;
};


export let removeAllQuery = () => {
    const baseUrl = `${location.protocol}//${location.host}${location.pathname}`;
    window.history.replaceState({}, '', baseUrl);
    return false;
};

export let getParams = () => {
    const queryParams = document.location.search;
    if (document.location.search) {
        const keyRegex = new RegExp('([a-zA-Z]*[^&]*)', 'gi');
        let params = {};
        queryParams.match(keyRegex).map((val) => {
            if(val === '') return ;
            if(val.includes('&') || val.includes('?')){
                val = val.substr(1,);
            }
            let [query, value] = val.split('=');
            Object.assign(params, {
                [decodeURIComponent(query)]: decodeURIComponent(value)
            })
        });
        return params;
    }
    return {};

}
