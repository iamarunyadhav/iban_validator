import axios from 'axios';
import config from '@/config';

export const register = (userData) => {
  return axios.get(`${config.baseUrl}/sanctum/csrf-cookie`).then(() => {
    return axios.post(`${config.apiUrl}/v1/register`, userData, { withCredentials: true });
  });
};

export const login = (credentials) => {
  return axios.get(`${config.baseUrl}/sanctum/csrf-cookie`).then(() => {
    return axios.post(`${config.apiUrl}/v1/login`, credentials, { withCredentials: true });
  });
};
