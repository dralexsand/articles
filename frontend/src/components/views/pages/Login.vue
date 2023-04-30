<template>

  <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">

    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img
          class="mx-auto h-10 w-auto"
          src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
          alt="Articles"/>

      <h2
          class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
        {{ info.text_title }}
      </h2>

    </div>

    <div
        class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6">

        <div v-if="modeForm === 'register'">
          <label
              for="name"
              class="block text-sm font-medium leading-6 text-gray-900">
            Name
          </label>

          <div class="mt-2">
            <input
                v-model="user.name"
                name="name" type="email" autocomplete="name" required=""
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>

        <div>
          <label
              for="email"
              class="block text-sm font-medium leading-6 text-gray-900">
            Email
          </label>

          <div class="mt-2">
            <input
                v-model="user.email"
                name="email" type="email" autocomplete="email" required=""
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
              Password
            </label>
          </div>
          <div class="mt-2">
            <input
                v-model="user.password"
                name="password" type="password" autocomplete="current-password" required=""
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>

        <div>
          <button
              @click.prevent="onClick"
              type="submit"
              class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            {{ info.text_button }}
          </button>
        </div>

      </form>

      <p class="mt-10 text-center text-sm text-gray-500">

        <span
            class="font-normal leading-6 text-gray-500 hover:text-indigo-500">
        {{ info.text_footer_1 }}
        </span>
        <span
            @click="onSwitch()"
            class="swith-mode-title pl-1 font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
        {{ info.text_footer_2 }}
        </span>
      </p>

    </div>


    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">

        <span class="font-normal leading-6 text-red-400 hover:text-red-500">
            {{ state.errorMessage }}
        </span>

      </div>
    </div>

  </div>
</template>
<script>
import {onMounted, reactive, computed, ref} from "vue";
import {useStore} from "vuex";
import {useRoute} from "vue-router";
import uiSimpleButton from "../../ui/uiSimpleButton.vue";

export default {
  components: {
    uiSimpleButton
  },
  props: {},
  setup: function () {

    const store = useStore()
    const router = useRoute()

    const delay = ms => new Promise(res => setTimeout(res, ms));

    const timeOut = async (ms) => {
      await delay(ms);
    };

    const timeOutRefresh = async (ms) => {
      await delay(ms);
      window.location = "/"
    };

    onMounted(() => {
      //console.log(route)
    })

    const info = ref({
      text_title: 'Sign in to your account',
      text_footer_1: 'Unregistered user?',
      text_footer_2: 'Register',
      text_button: 'Sign in',
    })

    const user = ref({
      email: '',
      password: '',
      name: '',
      id: '',
    })

    const modeForm = ref('login')

    const isUser = ref(false);

    const onClick = () => {
      let userData = user.value
      let data = {}

      if (modeForm.value === 'login') {
        data = {
          email: userData.email,
          password: userData.password,
          user_id: userData.id,
        }
        store.dispatch('auth/FETCH_LOGIN', data)
        //router.push('/')
      } else if (modeForm.value === 'register') {
        data = {
          email: userData.email,
          password: userData.password,
          name: userData.name,
          user_id: userData.id,
        }
        store.dispatch('auth/FETCH_REGISTER', data)
      }
      timeOut(100)

      store.dispatch('auth/FETCH_USER', userData.email)

      timeOutRefresh(500)
    }

    const state = reactive({
      errorMessage: computed({
        get() {
          let errors = store.getters["auth/GET_ERROR"]
          //return errors.code + ',' + errors.message + ',' + errors.statusText;
          return errors.statusText;
        }
      }),
    })

    const onSwitch = () => {
      let mode = modeForm.value === 'login' ? 'register' : `login`;
      switchMode(mode);
    }

    const switchMode = (mode) => {
      switch (mode) {
        case 'login':
          modeForm.value = 'login';
          info.value = {
            text_title: 'Sign in to your account',
            text_footer_1: 'Unregistered user?',
            text_footer_2: 'Register',
            text_button: 'Sign in',
          }
          break;
        case 'register':
          modeForm.value = 'register';
          info.value = {
            text_title: 'Create your account',
            text_footer_1: 'Registered?',
            text_footer_2: 'Login',
            text_button: 'Register',
          }
          break;
      }
    }

    return {
      user,
      modeForm,
      onClick,
      onSwitch,
      info,
      //errorMessage,
      isUser,
      state
    }
  }
}
</script>
<style scoped>
.swith-mode-title:hover {
  cursor: pointer;
}
</style>