const setCookie = (name, value, days) => {
    const expiryDate = new Date();
    expiryDate.setDate(expiryDate.getDate() + days);

    const cookieString = `${name}=${value}; expires=${expiryDate.toUTCString()}; path=/; secure`;

    document.cookie = cookieString;
}

const getCookie = (name) => {
    const cookies = document.cookie.split('; ');
    const cookie = cookies.find(row => row.startsWith(`${name}=`));

    return cookie ? cookie.split('=')[1] : null;
}

const deleteCookie = (name) => {
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; secure`;
}

export default { setCookie, getCookie, deleteCookie }