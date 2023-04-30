<template>

  <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">

        <span class="font-normal leading-6 text-red-400 hover:text-red-500">
            {{ state.info }}
        </span>

    </div>
  </div>

  <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">

    <div
        v-if="mode==='view'"
    >
      <ui-form-view
          :form="dataForm"
      />
    </div>
    <div
        v-if="mode==='edit'"
    >
      <ui-form
          :form="dataForm"
          @handleApply="onHandleApply"
          mode="edit"
      />
    </div>

    <div
        v-if="mode==='create'"
    >
      <ui-form
          :form="dataForm"
          @handleApply="onHandleApply"
          mode="create"
      />

    </div>

  </div>

</template>
<script>
import {useRoute} from 'vue-router'
import {useStore} from "vuex";
import {computed, onMounted, reactive, ref} from "vue";
import {apiGet, apiPut} from "../../../use/methods.js";
import uiForm from "../../ui/uiForm.vue";
import uiFormView from "../../ui/uiFormView.vue";
import {baseApiUrl} from "../../../use/states.js";
import moment from "moment/moment.js";

export default {
  components: {
    uiFormView,
    uiForm,
  },
  props: {},
  setup() {

    const route = useRoute()
    const store = useStore()

    const mode = ref('')

    const post = ref({})

    const postId = ref(null)

    const dataForm = ref({})

    const state = reactive({
      info: computed({
        get() {
          let errors = store.getters["posts/GET_DATA_ERROR"]
          let message = errors.length === 0 ? errors : 'Successful';
          //return errors.code + ',' + errors.message + ',' + errors.statusText;
          return message;
        }
      }),
    })

    onMounted(() => {
      mode.value = route.name

      if (mode.value === 'edit') {
        postId.value = route.params.id
        loadPost(route.params.id)
      } else if (mode.value === 'create') {
        showNewPost()
      }
    })

    const loadPost = () => {
      store.dispatch('posts/FETCH_POST', postId.value)
      let data = store.getters['posts/GET_POST']
      showPost(data)
    }

    const showNewPost = () => {
      let dForm = {
        title: '',
        description: '',
        content: '',
        published: moment().format('YYYY-MM-DD HH:m:s'),
        author: '',
      }

      dataForm.value = dForm
    }

    const showPost = (data) => {
      post.value = data.data
      let dForm = {
        title: data.data.title,
        description: data.data.description,
        content: data.data.content,
        published: data.data.created_at,
        author: data.data.author.full_name,
      }
      dataForm.value = dForm
    }

    const onHandleApply = (item) => {
      let storeData = {}
      if (mode.value == 'edit') {
        storeData = getUpdatePostData(item.value)
        //console.log(storeData)
        store.dispatch('posts/UPDATE_POST', storeData)
      } else {
        storeData = getCreatePostData(item.value)
        //console.log(storeData)
        store.dispatch('posts/CREATE_POST', storeData)
      }
    }

    function getCreatePostData(data) {
      let params = {
        title: data.title,
        description: data.description,
        content: data.content,
        author_id: data.author_id,
      }
      return params
    }

    function getUpdatePostData(data) {
      let params = {
        id: postId.value,
        title: data.title,
        description: data.description,
        content: data.content,
        author_id: post.value.author.id
      }
      return params
    }

    return {
      post,
      dataForm,
      onHandleApply,
      mode,
      postId,
      state,
    }

  }
}
</script>