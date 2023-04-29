<template>

  <p class="text-3xl text-gray-700 font-bold mb-5">
    {{ mode === 'view' ? 'View post #' + post.id : 'Edit post #' + post.id }}
  </p>

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

  </div>

</template>
<script>
import {useRoute} from 'vue-router'
import {onMounted, ref} from "vue";
import {apiGet, apiPut} from "../../../use/methods.js";
import uiForm from "../../ui/uiForm.vue";
import uiFormView from "../../ui/uiFormView.vue";
import {baseApiUrl} from "../../../use/states.js";

export default {
  components: {
    uiFormView,
    uiForm
  },
  props: {},
  setup() {

    const route = useRoute()

    const mode = ref('')

    const post = ref({})

    const dataForm = ref({})

    const loadPost = (postId) => {
      let url = baseApiUrl + '/posts/' + postId
      apiGet(url, showPost)
    }

    const updatePost = (postId, data) => {
      let params = {
        title: data.title,
        description: data.description,
        content: data.content,
        author_id: post.value.author.id
      }

      let url = baseApiUrl + '/posts/' + postId
      apiPut(url, params, showPost)
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

    onMounted(() => {
      mode.value = route.name
      if (route.params.id !== null) {
        loadPost(route.params.id)
      }
    })

    const onHandleApply = (item) => {
      updatePost(post.value.id, item.value)
    }

    return {
      post,
      dataForm,
      onHandleApply,
      mode
    }

  }
}
</script>