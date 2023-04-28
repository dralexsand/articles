<template>
  <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
    <p
        v-if="$route.name==='view'"
        class="text-3xl text-gray-700 font-bold mb-5">
      View <strong>item: </strong> {{ item.id }}

      <ui-form-view
          :form="dataForm"
      />

    </p>

    <p
        v-if="$route.name==='edit'"
        class="text-3xl text-gray-700 font-bold mb-5">
      Edit <strong>item: </strong> {{ item.id }}

      <ui-form
          :form="dataForm"
      />

    </p>

    <p
        v-if="$route.name==='create'"
        class="text-3xl text-gray-700 font-bold mb-5">
      Create <strong>item: </strong> {{ item.id }}
    </p>

  </div>

</template>
<script>
import {useRoute} from 'vue-router'
import {onMounted, reactive, ref} from "vue";
import {apiGet} from "../../../use/methods.js";
import uiForm from "../../ui/uiForm.vue";
import uiFormView from "../../ui/uiFormView.vue";
import UiFormView from "../../ui/uiFormView.vue";

export default {
  components: {
    UiFormView,
    uiForm
  },
  props: {},
  setup() {

    const route = useRoute()

    const item = ref({})

    const dataForm = ref({})

    const baseApiUrl = 'http://127.0.0.1:8097/api/v1';

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

    onMounted(() => {
      item.value = route.params

      if (route.params.id !== null) {
        loadPost(route.params.id)
      }
    })

    return {
      item,
      dataForm
    }

  }
}
</script>