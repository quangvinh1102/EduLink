// import { ref } from 'vue';

// export default (await import('vue')).defineComponent({
//     setup() {

//         const articles = ref([]);

//         const getArticles = () => {
//             axios.get('/api/article/index')
//                 .then((response) => {
//                     console.log(response);
//                     articles.value = response.data;
//                 });
//         };
//         getArticles();

//         const hiddenArticle = (e) => {
//             const className = e.currentTarget.parentNode.parentNode.parentNode.parentNode;
//             // const articleId = document.getAttribute('article-id')
//             console.log(className);
//         };
//         return {
//             articles,
//             hiddenArticle
//         };
//     }
// });
