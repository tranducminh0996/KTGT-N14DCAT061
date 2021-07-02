import axios from 'axios';
import { Message } from 'element-ui';

// Create axios instance
const service = axios.create({
  baseURL: process.env.MIX_BASE_API,
  timeout: 60 * 10 * 1000, // Request timeout
});

// request拦截器
service.interceptors.request.use(
  config => {
      config.headers['Content-Type'] = 'application/json '; // Set JWT token
      config['_token'] = window.token;
    return config;
  },
  error => {
    // Do something with request error
    console.log(error, '123123'); // for debug
    Promise.reject(error);
    window.location.reload();
  }
);

// response pre-processing

export default service;
