<template>

  <router-link to="/">
    <ui-simple-button
        label="Go home"
    />
  </router-link>

  <div class="container my-24 px-6 mx-auto">

    <section class="mb-32 text-gray-800">
      <h4 class="font-bold text-1xl mb-4">
        {{ form.title }}
      </h4>

      <p class="note note-light border-l-4 border-gray-800 rounded p-2 mb-6">
        {{ form.description }}
      </p>

      <p class="mb-6">
        {{ form.content }}
      </p>

      <p class="mb-6">
       <strong>{{ form.author }}</strong>
      </p>

      <p class="mb-6">
        {{ form.published }}
      </p>

    </section>

  </div>

</template>
<script>
import uiSimpleButton from "./uiSimpleButton.vue";
import {onMounted, ref} from "vue";

export default {
  components: {
    uiSimpleButton
  },
  props: {
    form: {}
  },
  setup(props) {

    const contentPage = ref({})

    onMounted(() => {
      //contentPage.value = props.form
    })

    return {
      contentPage
    }
  }
}
</script>
<style>
section p {
  font-size: 14px;
  font-weight: normal;
}
</style>