class Form {
    constructor(data) {
        this.originalData = JSON.parse(JSON.stringify(data));

        Object.assign(this, data);

        this.errors = {};
        this.submitted = false;
    }

    data() {
        return Object.keys(this.originalData).reduce((data, attribute) => {
            if (this[attribute]) {
                data[attribute] = this[attribute];
            }
            return data;
        }, {});
    }

    post(endpoint, headers) {
        return this.submit(endpoint, 'post', headers);
    }

    patch(endpoint) {
        return this.submit(endpoint, 'patch');
    }

    put(endpoint) {
        return this.submit(endpoint, 'put');
    }

    delete(endpoint) {
        return this.submit(endpoint, 'delete');
    }

    submit(endpoint, requestType = 'post', headers) {
        return axios[requestType](endpoint, this.data(), headers)
            .catch(this.onFail.bind(this))
            .then(this.onSuccess.bind(this));
    }

    onSuccess(response) {
        this.submitted = true;
        this.errors = {};

        return response;
    }

    onFail(error) {
        this.errors = error.response.data.errors;
        this.submitted = false;

        throw error;
    }

    reset() {
        Object.assign(this, this.originalData);
    }
}

export default Form;