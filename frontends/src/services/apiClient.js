// src/services/apiClient.js
import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
  withCredentials: true,
  headers: {
    'Content-Type': 'application/json',
    // Add any additional headers if needed
  }
});

apiClient.interceptors.response.use(response => response, error => {
  // Optional: Handle global API error responses here
  return Promise.reject(error);
});

export default apiClient;
