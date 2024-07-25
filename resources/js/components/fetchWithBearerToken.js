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
  
    // Add the payload to the request body for POST and PUT methods
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