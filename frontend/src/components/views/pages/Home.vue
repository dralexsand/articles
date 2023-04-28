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

    <ui-simple-button
        label="Apply filters"
        @click="onClickApplyFilters"
    />

    <ui-hr/>

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
import {apiGet} from "../../../use/methods.js";
import uiTable from "../../ui/uiTable.vue";
import uiFilterBox from "../../ui/uiFilterBox.vue";
import uiHr from "../../ui/uiHr.vue";
import uiSimpleButton from "../../ui/uiSimpleButton.vue";

export default {
  components: {
    uiTable,
    uiFilterBox,
    uiHr,
    uiSimpleButton,
  },
  props: {},
  setup() {
    const posts = ref({})
    const pagination = ref({})

    const dataFormsCheckBoxes = [
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
      {
        name: "author",
        class: "w-5 h-5 border border-gray-300 rounded-sm outline-none cursor-pointer",
        label: "Author",
      },
    ]

    function filteredListInit() {
      let item = {}
      let list = [];
      for (let entry of dataFormsCheckBoxes) {
        item = {
          name: entry.name,
          value: false
        }
        list.push(item)
      }
      return list;
    }

    const filterValues = ref({})

    const baseApiUrl = 'http://127.0.0.1:8097/api/v1';

    const loadPosts = (page = null) => {
      let url = getPostsPageUrl(page) + getFilters()
      //console.log(url)
      apiGet(url, showPosts)
    }

    const onChangeFilters = (item) => {
      //console.log(item)
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
      for (let entry of filterValues.value) {
        if (entry.value !== false) {
          filters += entry.name + ":" + entry.value + ",";
        }
      }
      filters = filters.substring(0, filters.length - 1);
      return '&filter=' + filters;
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
      filterValues.value = filteredListInit()
      loadPosts()
    })

    const onClickApplyFilters = (item) => {
      //console.log('onClickApplyFilters clicked')
      loadPosts()
    }

    const onHandleAction = (item) => {
      //console.log('onHandleView clicked')
      console.log(item)
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
    }
  }
}
</script>