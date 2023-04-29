<template>
  <p
      v-if="$route.name==='create'"
      class="text-3xl text-gray-700 font-bold mb-5">
    Create new post:
  </p>

  <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">

      <ui-form
          :form="dataForm"
          @handleApply="onHandleApply"
      />

  </div>

</template>
<script>
import {useRoute} from 'vue-router'
import {onMounted, ref} from "vue";
import {apiGet} from "../../../use/methods.js";
import uiForm from "../../ui/uiForm.vue";
import moment from "moment";
import {baseApiUrl} from "../../../use/states.js";

export default {
  components: {
    uiForm
  },
  props: {},
  setup() {

    const route = useRoute()

    const dataForm = ref({})

    const loadPost = (page) => {
      let url = baseApiUrl + '/posts/' + page
      apiGet(url, showPost)
    }

    const showPost = (data) => {
      //console.log(data.data)
      let dForm = {
        title: data.data.title,
        description: data.data.description,
        content: data.data.content,
        published: data.data.created_at,
        author: data.data.author.full_name,
      }

      dataForm.value = dForm
    }

    const showNewPost = () => {
      //console.log(data.data)
      let dForm = {
        title: '',
        description: '',
        content: '',
        published: moment().format('YYYY-MM-DD HH:m:s'),
        author: '',
      }

      dataForm.value = dForm
    }

    onMounted(() => {
      showNewPost()
      //console.log(dataForm.value)
    })

    const onHandleApply = (item) => {
      console.log('onHandleApply clicked')
      console.log(item)
    }

    return {
      dataForm,
      onHandleApply
    }

  }
}
</script>