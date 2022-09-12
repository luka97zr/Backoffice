export default function parseJwt(token) {
    if (!token) return;
    console.log(token);
        const base64Url = token.split(".")[1];
        const base64 = base64Url.replace("-", "+").replace("_", "/");
        const {email, name, role} = JSON.parse(window.atob(base64));
        const user = {
            email : email,
            role: role,
            name: name,
            id: id
        }
}