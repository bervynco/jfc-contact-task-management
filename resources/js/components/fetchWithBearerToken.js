export async function fetchWithBearerToken(url, method = 'GET', payload = {}, options = {}) {
    const token = localStorage.getItem('jfc-token');
    const headers = {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      ...options.headers
    };
  
    if (token) {
      headers['Authorization'] = `Bearer ${token}`;
    }
  
    const fetchOptions = {
      method,
      headers,
      ...options,
    };
  
    if (method === 'POST' || method === 'PUT') {
        fetchOptions.body = JSON.stringify(payload);
    }
  
    const response = await fetch(url, fetchOptions);
  
    if (!response.ok) {
      throw new Error(`Error: ${response.status}`);
    }
  
    return response.json();
  }

export default fetchWithBearerToken;