import apiClient from './apiClient';

const UserService = {
  register(data) {
    return apiClient.post('/register', data);
  },
  login(data) {
    return apiClient.post('/login', data);
  },
  logout() {
    return apiClient.post('/logout');
  },
  iban()
  {
    return apiClient.post('/check');
  }
};

export default UserService;
