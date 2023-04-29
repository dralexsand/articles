<template>

  <router-link to="/">
    <ui-simple-button
        label="Go home"
    />
  </router-link>

  <div
      class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">

    <div class="container my-24 px-6 mx-auto">

      <section class="mb-32 text-gray-800">

        <form>
          <div class="form-group mb-6">
            <label>Title</label>
            <input type="text"
                   class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                   id="exampleInput7"
                   :placeholder="form.title === '' ? 'title' : ''"
                   v-model.trim="form.title"
            />
          </div>

          <div class="form-group mb-6">
            <label>Description</label>
            <input type="text"
                   class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                   id="exampleInput7"
                   :placeholder="form.description === '' ? 'description' : ''"
                   v-model.trim="form.description"
            />
          </div>

          <div class="form-group mb-6">
            <label>Content</label>
            <textarea
                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                id="exampleFormControlTextarea13"
                rows="3"
                :placeholder="form.content === '' ? 'content' : ''"
                v-model.trim="form.content"
            ></textarea>
          </div>

          <div class="form-group mb-6">
            <label>Author</label>
            <input
                :disabled="mode === 'edit'"
                :class="mode === 'edit'? 'disabled' : ''"
                   type="text"
                   class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                   id="exampleInput7"
                   :placeholder="form.author === '' ? 'author' : ''"
                   v-model.trim="form.author"
            />
          </div>

          <div class="form-group mb-6">
            <label>Published</label>
            <p class="mb-6">
              {{ form.published }}
            </p>
          </div>

          <div class="form-group mb-6">
            <p class="mb-6 text-red-500">
              {{ errorMessage }}
            </p>
          </div>

        </form>
      </section>

    </div>

    <ui-simple-button
        label="Apply"
        @click="onClickApply"
    />

  </div>
</template>
<script>
import uiSimpleButton from "./uiSimpleButton.vue";
import {onMounted, ref} from "vue";
import {isValidated, errorMessage, validateFormData} from "../../use/states.js";

export default {
  components: {
    uiSimpleButton
  },
  props: {
    mode: {},
    form: {}
  },
  emits: [
    'handleApply'
  ],
  setup(props, {emit}) {

    const onClickApply = () => {
      validateFormData(props.form)
      if (isValidated.value) {
        console.log('post create')
        emit('handleApply', {
          type: 'createForm',
          value: props.form
        })
      } else {
        console.log('error validation')
      }
    }

    return {
      onClickApply,
      isValidated,
      errorMessage
    }
  }
}
</script>
<style scoped>
label {
  font-weight: bold;
}
.disabled {
  background-color: #eeeded;
}
</style>