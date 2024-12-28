// services/IbanService.js
import axios from 'axios';
import config from '@/config';

const apiUrl = config.apiUrl;

export const getCsrfCookie = () => {
    return axios.get('/sanctum/csrf-cookie');
};

export const validateIban = (iban, token) => {
    const payload = { iban, id: localStorage.getItem('user_id') };
    return axios.post(`${apiUrl}/v1/ibans/check`, payload, {
        headers: { Authorization: `Bearer ${token}` }
    });
};


export const fetchIbanList = (page, token) => {
  return axios.get(`${config.apiUrl}/v1/users/ibans/list?page=${page}`, {
    headers: { Authorization: `Bearer ${token}` }
  });
};


