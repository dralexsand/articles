<template>
  <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
    <p class="text-3xl text-gray-700 font-bold mb-5">
      Posts list
    </p>

    <ui-table
        :posts="posts"
        :pagination="pagination"
    >
    </ui-table>

  </div>
</template>
<script>
import {computed, onMounted, ref} from "vue";
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

    const onClickPagination = (item) => {
      console.log(item)
    }

    function getFilters() {
      return '&filter=';
      //return '?filter=title:Prohaska-Kirlin,color:red'
    }

    function getPageLink(page) {
      let link = '';
      let pageLink = '';
      switch (page) {
        case 'first':
          link = props.pagination.path
          break;
        case 'last':
          link = props.pagination.path + '?' + props.pagination.pageName + '=' + props.pagination.lastPage
          break;
        case 'prev':
          pageLink = props.pagination.currentPage === 1 ? '' : parseInt(props.pagination.currentPage) - 1;
          link = props.pagination.path + '?' + props.pagination.pageName + '=' + pageLink
          break;
        case 'next':
          pageLink = props.pagination.currentPage === props.pagination.lastPage ? '' : parseInt(props.pagination.props.pagination.lastPage) + 1;
          link = props.pagination.path + '?' + props.pagination.pageName + '=' + pageLink
          break;
      }
      return link;
    }

    function getPostsPageUrl(page = null) {
      page = page === null ? '?page=1' : '?page=' + page
      return baseApiUrl + '/posts' + page;
    }

    const showPosts = (data) => {
      posts.value = data.data.posts
      pagination.value = data.data.pagination
      //let pg = data.data.pagination;

      /*pagination.value = {
        first: data.data.pagination.path,
        last: pg.path + '?' + pg.pageName + '=' + pg.lastPage,
        prev: pg.path + '?' + pg.pageName + '=' + parseInt(pg.currentPage) - 1,
        next: pg.currentPage === pg.lastPage ? '' : parseInt(pg.lastPage) + 1,
      }*/

      /*case 'first':
        link = props.pagination.path
        break;
      case 'last':
        link = props.pagination.path + '?' + props.pagination.pageName + '=' + props.pagination.lastPage
        break;
      case 'prev':
        pageLink = props.pagination.currentPage === 1 ? '' : parseInt(props.pagination.currentPage) - 1;
        link = props.pagination.path + '?' + props.pagination.pageName + '=' + pageLink
        break;
      case 'next':
        pageLink = props.pagination.currentPage === props.pagination.lastPage ? '' : parseInt(props.pagination.props.pagination.lastPage) + 1;*/

    }

    onMounted(() => {
      //console.log('onMounted');
      loadPosts()
    })

    return {
      posts,
      pagination,
      onClickPagination
    }
  }
}
</script>