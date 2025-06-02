// var Constants = {
//     API_BASE_URL: "http://localhost/intro-to-web-2025/backend/",
// };
var Constants = {
    get_api_base_url: function () {
        if (location.hostname == "localhost") {
            return "http://localhost/intro-to-web-2025/backend/";
        } else {
            return "https://seal-app-qfrpl.ondigitalocean.app/backend/";
        }
    },
};