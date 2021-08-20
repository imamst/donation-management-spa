import axios from 'axios'

let API = axios.create({
    baseURL: `${process.env.MIX_APP_URL}/api`
});

API.defaults.withCredentials = true

export default API;