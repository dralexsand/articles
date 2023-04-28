import axios from "axios";

export const apiGet = (url, callback = null) => {
    axios
        .get(url)
        .then(function (response) {
            // handle success
            //console.log(response.data)
            if (callback !== null) {
                callback(response.data)
            }
        })
        .catch(function (error) {
            // handle error
            console.log(error)
        })
        .then(function () {
            // always executed
        });
}

/*export const apiGet = async (url, callback = null) => {
    await axios
        .get(url)
        .then(function (response) {
            // handle success
            //console.log(response.data)
            if (callback !== null) {
                callback(response.data)
            }
        })
        .catch(function (error) {
            // handle error
            console.log(error)
        })
        .then(function () {
            // always executed
        });
}*/

export const apiDelete = async (url, callback = null) => {
    await axios
        .get(url)
        .then(function (response) {
            // handle success
            //console.log(response.data)
            if (callback !== null) {
                callback(response.data)
            }
        })
        .catch(function (error) {
            // handle error
            console.log(error)
        })
        .then(function () {
            // always executed
        });
}

export const apiPost = async (url, params, callback = null) => {
    await axios
        .post(url, params)
        .then(function (response) {
            // handle success
            //console.log(response.data)
            if (callback !== null) {
                callback(response.data)
            }
        })
        .catch(function (error) {
            // handle error
            console.log(error)
        })
        .then(function () {
            // always executed
        });
}

export const apiPut = async (url, params, callback = null) => {
    await axios
        .put(url, params)
        .then(function (response) {
            // handle success
            //console.log(response.data)
            if (callback !== null) {
                callback(response.data)
            }
        })
        .catch(function (error) {
            // handle error
            console.log(error)
        })
        .then(function () {
            // always executed
        });
}

//export const baseApiUrl = getBaseApiUrl()
