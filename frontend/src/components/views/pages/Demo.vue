<template>

  <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">

    <h2>Demo</h2>

    <!--Email input-->
    <div class="relative mb-3">
      <input
          type="email"
          class="peer m-0 block h-[58px] w-full rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-4 text-base font-normal leading-tight text-neutral-700 transition duration-200 ease-linear placeholder:text-transparent focus:border-primary focus:pb-[0.625rem] focus:pt-[1.625rem] focus:text-neutral-700 focus:outline-none peer-focus:text-primary dark:border-neutral-600 dark:text-neutral-200 dark:focus:border-primary dark:peer-focus:text-primary [&:not(:placeholder-shown)]:pb-[0.625rem] [&:not(:placeholder-shown)]:pt-[1.625rem]"
          id="floatingInput"
          placeholder="name@example.com"/>
      <label
          for="floatingInput"
          class="pointer-events-none absolute left-0 top-0 origin-[0_0] border border-solid border-transparent px-3 py-4 text-neutral-500 transition-[opacity,_transform] duration-200 ease-linear peer-focus:-translate-y-2 peer-focus:translate-x-[0.15rem] peer-focus:scale-[0.85] peer-focus:text-primary peer-[:not(:placeholder-shown)]:-translate-y-2 peer-[:not(:placeholder-shown)]:translate-x-[0.15rem] peer-[:not(:placeholder-shown)]:scale-[0.85] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
      >Email address</label
      >
    </div>

    <!--Password input-->
    <div class="relative mb-3">
      <input
          type="text"
          class="peer m-0 block h-[58px] w-full rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-4 text-base font-normal leading-tight text-neutral-700 transition duration-200 ease-linear placeholder:text-transparent focus:border-primary focus:pb-[0.625rem] focus:pt-[1.625rem] focus:text-neutral-700 focus:shadow-te-primary focus:outline-none peer-focus:text-primary dark:border-neutral-600 dark:text-neutral-200 dark:focus:border-primary dark:peer-focus:text-primary [&:not(:placeholder-shown)]:pb-[0.625rem] [&:not(:placeholder-shown)]:pt-[1.625rem]"
          id="floatingPassword"
          placeholder="Password"/>
      <label
          for="floatingPassword"
          class="pointer-events-none absolute left-0 top-0 origin-[0_0] border border-solid border-transparent px-3 py-4 text-neutral-500 transition-[opacity,_transform] duration-200 ease-linear peer-focus:-translate-y-2 peer-focus:translate-x-[0.15rem] peer-focus:scale-[0.85] peer-focus:text-primary peer-[:not(:placeholder-shown)]:-translate-y-2 peer-[:not(:placeholder-shown)]:translate-x-[0.15rem] peer-[:not(:placeholder-shown)]:scale-[0.85] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
      >
        Password
      </label
      >
    </div>

    <ui-simple-button
        @click.prevent="onClickLogin()"
        label="Login"
    />

    <ui-simple-button
        @click.prevent="onClickTest()"
        label="Test"
    />

  </div>

</template>
<script>
import {onMounted, ref} from "vue";
import {useStore} from "vuex";
import {useRouter} from "vue-router";
import uiSimpleButton from "../../ui/uiSimpleButton.vue";
import {baseApiUrl, checkAuth} from "../../../use/states.js";

export default {
  components: {
    uiSimpleButton
  },

  setup() {

    const store = useStore()
    const router = useRouter()

    onMounted(() => {
      if(checkAuth(store)){
        let token = store.state.auth.token
        let user = store.state.auth.user
        console.log('user init');
        console.log(user);
        console.log('token init');
        console.log(token);
      } else {
        router.push('/login')
      }
    })

    const onClickLogin = () => {

      let data = {
        email: 'admin@mail.com',
        password: 'password'
      }

      store.dispatch('auth/FETCH_LOGIN', data)
      //store.dispatch('')
      //console.log(store.state.)

    }

    const onClickTest = () => {
      let url = baseApiUrl + '/authors_list'
      //apiGetHeaders(url)
    }

    const delay = ms => new Promise(res => setTimeout(res, ms));

    const timeOutRefresh = async (ms) => {
      await delay(ms);
    };

    const onLogin = (data) => {
      timeOutRefresh(1000)
      //TOKEN.value = data.access_token
      //store.state.commit()

      //console.log(data.access_token)
      //token.value = data.access_token
      //console.log(config.value)
    }

    return {
      onClickLogin,
      //onLogin,
      onClickTest,
      //onLoginLoad
    }
  }
}
</script>