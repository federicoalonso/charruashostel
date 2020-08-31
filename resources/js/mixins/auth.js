let user = document.head.querySelector('meta[name="user"]');

module.exports = {
    computed: {
        actualUser() {
            return JSON.parse(user.content);
        },
        autenticado(){
            return !! user.content;
        }
    },
};