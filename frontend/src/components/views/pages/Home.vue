<template>
  <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
    <p class="text-3xl text-gray-700 font-bold mb-5">
      Posts list
    </p>

    <p class="text-1xl text-gray-700 font-bold mb-5">
      Filters:
    </p>

    <div v-for="checkboxData in dataFormsCheckBoxes">
      <ui-filter-box
          :form="checkboxData"
          @handleUiCheckBox="onChangeFilters"
      />
    </div>

    <ui-filter-select
        :authors="authors"
        @handleFilterSelect="onHandleFilterSelect"
    ></ui-filter-select>

    <ui-simple-button
        label="Apply filters"
        @click="onClickApplyFilters"
    />

    <span class="font-normal leading-6 text-red-400 hover:text-red-500">
        {{ errorMessage }}
    </span>

    <ui-hr/>

    <ui-simple-button
        label='New'
        @click="onHandleAction()"
    />

    <ui-table
        :posts="posts"
        :pagination="pagination"
        @handleSubmitTablePagination="onClickTablePagination"
        @handleAction="onHandleAction"
    >
    </ui-table>
  </div>
</template>
<script>
import {computed, onMounted, ref} from "vue";
import {useRoute, useRouter} from 'vue-router'
import {apiGet, apiDelete} from "../../../use/methods.js";
import uiTable from "../../ui/uiTable.vue";
import uiFilterBox from "../../ui/uiFilterBox.vue";
import uiFilterSelect from "../../ui/uiFilterSelect.vue";
import uiHr from "../../ui/uiHr.vue";
import uiSimpleButton from "../../ui/uiSimpleButton.vue";
import {baseApiUrl, checkAuth} from "../../../use/states.js";
import {useStore} from "vuex";

export default {
  components: {
    uiTable,
    uiFilterBox,
    uiFilterSelect,
    uiHr,
    uiSimpleButton,
  },
  props: {},
  setup() {

    const store = useStore()
    const router = useRouter()

    const posts = ref({})
    const pagination = ref({})

    const dataFormsCheckBoxes = ref([
      {
        name: "title",
        class: "w-5 h-5 border border-gray-300 rounded-sm outline-none cursor-pointer",
        label: "Title",
      },
      {
        name: "description",
        class: "w-5 h-5 border border-gray-300 rounded-sm outline-none cursor-pointer",
        label: "Description",
      },
      {
        name: "published",
        class: "w-5 h-5 border border-gray-300 rounded-sm outline-none cursor-pointer",
        label: "Published",
      },
      /*{
        name: "author",
        class: "w-5 h-5 border border-gray-300 rounded-sm outline-none cursor-pointer",
        label: "Author",
      },*/
    ])

    const authors = ref({});
    const author_id = ref(0);

    onMounted(() => {
      //console.log('onMounted');
      if (checkAuth(store)) {
        filterValues.value = filteredListInit()
        loadAuthors()
        loadPosts()
      } else {
        router.push('/login')
      }
    })

    function filteredListInit() {
      let item = {}
      let list = [];
      for (let entry of dataFormsCheckBoxes.value) {
        item = {
          name: entry.name,
          value: false
        }
        list.push(item)
      }
      return list;
    }

    const filterValues = ref({})

    const loadPosts = (page = null) => {
      let payload = getPostsPageUrl(page) + getFilters()
      store.dispatch('posts/FETCH_POSTS', payload)
      //timeOut(500)
      let postsData = store.getters['posts/GET_POSTS']
      posts.value = postsData.data.posts
      pagination.value = postsData.data.pagination
    }

    const errorMessage = ref('');
    const loadAuthors = () => {
      store.dispatch('posts/FETCH_AUTHORS', '')
      authors.value = store.getters['posts/GET_AUTHORS']
    }

    const onHandleFilterSelect = (item) => {
      author_id.value = item.value
    }

    const onChangeFilters = (item) => {
      let filters = []
      for (let entry of filterValues.value) {
        if (entry.name === item.name) {
          entry.value = item.value
        }
        filters.push(entry)
      }
      filterValues.value = filters
    }
    const onClickTablePagination = (item) => {
      loadPosts(item.value)
    }

    function getFilters() {
      let filters = ""

      if (parseInt(author_id.value) !== 0) {
        filters += 'author_id:' + author_id.value + ',';
      }

      for (let entry of filterValues.value) {
        if (entry.value !== false) {

          if (entry.name === 'published') {
            filters += "created_at:" + entry.value + ",";
          } else {
            filters += entry.name + ":" + entry.value + ",";
          }
        }
      }
      filters = filters.substring(0, filters.length - 1);
      // console.log(filters)
      return '&filter=' + filters;
      //return '&filter=title:Prohaska-Kirlin,color:red'
    }

    function getPostsPageUrl(page = null) {
      return page === null ? '?page=1' : '?page=' + page
    }

    function deletePost(postId) {
      let url = baseApiUrl + '/posts/' + postId;
      apiDelete(url)
      timeOutRefresh(500)
    }

    const delay = ms => new Promise(res => setTimeout(res, ms));

    const timeOutRefresh = async (ms) => {
      await delay(ms);
      loadPosts()
    };

    const timeOut = async (ms) => {
      await delay(ms);
    };

    const onClickApplyFilters = (item) => {
      //console.log('onClickApplyFilters clicked')
      loadPosts()
    }

    const onHandleAction = (item = null) => {
      if (item === null) {
        let path = '/create'
        router.push({path: path})
      } else if (item.type === 'view' || item.type === 'edit') {
        let path = '/' + item.type + '/' + item.value
        router.push({path: path})
      } else if (item.type === 'delete') {
        deletePost(item.value)
      }
    }

    const thClass = ref('px-3 py-3');
    const tdClass = ref('px-3 py-3');

    return {
      tdClass,
      thClass,
      posts,
      pagination,
      onClickTablePagination,
      dataFormsCheckBoxes,
      onChangeFilters,
      onClickApplyFilters,
      onHandleAction,
      authors,
      onHandleFilterSelect,
      errorMessage
    }
  }
}
</script>