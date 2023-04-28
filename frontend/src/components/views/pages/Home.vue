<template>
  <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
    <p class="text-3xl text-gray-700 font-bold mb-5">
      Posts list
    </p>

    <ui-table
        :posts="posts"
        :pagination="pagination"
        @handleSubmitTablePagination="onClickTablePagination"
    >
    </ui-table>

  </div>
</template>
<script>
import {onMounted, ref} from "vue";
import {apiGet} from "../../../use/methods.js";
import uiTable from "../../ui/uiTable.vue";
import uiPagination from "../../ui/uiPagination.vue";

export default {
  components: {
    uiTable,
    uiPagination
  },
  props: {},
  setup() {
    const posts = ref({})
    const pagination = ref({})

    const baseApiUrl = 'http://127.0.0.1:8097/api/v1';

    const loadPosts = (page = null) => {
      let url = getPostsPageUrl(page) + getFilters()
      //console.log(url)
      apiGet(url, showPosts)
    }

    const onClickTablePagination = (item) => {
      loadPosts(item.value)
    }

    function getFilters() {
      return '&filter=';
      //return '&filter=title:Prohaska-Kirlin,color:red'
    }

    function getPostsPageUrl(page = null) {
      page = page === null ? '?page=1' : '?page=' + page
      return baseApiUrl + '/posts' + page;
    }

    const showPosts = (data) => {
      posts.value = data.data.posts
      pagination.value = data.data.pagination
    }

    onMounted(() => {
      //console.log('onMounted');
      loadPosts()
    })

    return {
      posts,
      pagination,
      onClickTablePagination
    }
  }
}
</script>