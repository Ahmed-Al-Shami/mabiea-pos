// export const environment = {
//     URL: window.location.protocol + '//' + window.location.hostname,
// };

export const environment = {
    API_URL: window.location.origin.includes('127.0.0.1') || window.location.origin.includes('localhost')
        ? 'http://127.0.0.1:8000/'
        : 'https://mabiea-pos.binary-tm.com/',
};

// export const environment = {
//     URL: 'http://127.0.0.1:8000',
// };