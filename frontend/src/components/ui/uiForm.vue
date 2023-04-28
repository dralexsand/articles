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
            <input type="text"
                   class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                   id="exampleInput7"
                   placeholder="Name"
                   :value="form.title"
            />
          </div>

          <div class="form-group mb-6">
            <input type="text"
                   class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                   id="exampleInput7"
                   placeholder="description"
                   :value="form.description"
            />
          </div>

          <div class="form-group mb-6">
        <textarea
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="exampleFormControlTextarea13"
            rows="3"
            placeholder="Content"
            :value="form.content"
        ></textarea>
          </div>

          <div class="form-group mb-6">
            <input type="text"
                   class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                   id="exampleInput7"
                   placeholder="description"
                   :value="form.published"
            />
          </div>

          <div class="form-group mb-6">
            <input type="text"
                   class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                   id="exampleInput7"
                   placeholder="description"
                   :value="form.author"
            />
          </div>

        </form>
      </section>

    </div>

    <ui-simple-button
        label="Apply"
    />

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
      //console.log(props.form.value)
    })

    return {
      contentPage
    }
  }
}
</script>
<style>

</style>