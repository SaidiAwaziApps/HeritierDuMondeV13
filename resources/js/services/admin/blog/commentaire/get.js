import axios from "axios";

class GetCommentService {
    static getAll(article_id) {
        return axios.get('/admin/article/'+article_id+'/get-comments');
    }
}

export default GetCommentService;