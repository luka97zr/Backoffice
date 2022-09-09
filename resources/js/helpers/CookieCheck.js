export default function doesCookieExist(cookiename) {
    const date = new Date();
    date.setTime(date.getTime() + (1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = cookiename + "=new_value;path=/;" + expires;
    return document.cookie.indexOf(cookiename + '=') == -1;
}