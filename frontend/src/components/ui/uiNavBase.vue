<template>
  <!-- Main navigation container -->
  <nav
      class="flex-no-wrap relative flex w-full items-center justify-between bg-neutral-100 py-2 shadow-md shadow-black/5 dark:bg-neutral-600 dark:shadow-black/10 lg:flex-wrap lg:justify-start lg:py-4"
      data-te-navbar-ref>
    <div class="flex w-full flex-wrap items-center justify-between px-3">
      <!-- Hamburger button for mobile view -->
      <button
          class="block border-0 bg-transparent px-2 text-neutral-500 hover:no-underline hover:shadow-none focus:no-underline focus:shadow-none focus:outline-none focus:ring-0 dark:text-neutral-200 lg:hidden"
          type="button"
          data-te-collapse-init
          data-te-target="#navbarSupportedContent1"
          aria-controls="navbarSupportedContent1"
          aria-expanded="false"
          aria-label="Toggle navigation">
        <!-- Hamburger icon -->
        <span class="[&>svg]:w-7">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="h-7 w-7">
          <path
              fill-rule="evenodd"
              d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
              clip-rule="evenodd"/>
        </svg>
      </span>
      </button>

      <!-- Collapsible navigation container -->
      <div
          class="!visible hidden flex-grow basis-[100%] items-center lg:!flex lg:basis-auto"
          id="navbarSupportedContent1"
          data-te-collapse-item>

        <!-- Left navigation links -->
        <ul
            class="list-style-none mr-auto flex flex-col pl-0 lg:flex-row"
            data-te-navbar-nav-ref>

          <li
              v-for="item in items"
              class="mb-4 lg:mb-0 lg:pr-2" data-te-nav-item-ref>

            <router-link
                class="text-neutral-500 hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-zinc-400"
                :to="item.path"
                data-te-nav-link-ref
            >
              {{ item.name }}
            </router-link
            >
          </li>

        </ul>
      </div>

      <!-- Right elements -->
      <div class="relative flex items-center">


        <div v-if="state.isAuth"
             class="relative" data-te-dropdown-ref>
          <a
              class="hidden-arrow mr-4 flex items-center text-neutral-500 hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
              id="dropdownMenuButton2"
              role="button"
              data-te-dropdown-toggle-ref
              aria-expanded="false">
            Hello, {{ state.userData.name }}
          </a>
          <ul
              class="absolute left-auto right-0 z-[1000] float-left m-0 mt-1 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
              aria-labelledby="dropdownMenuButton2"
              data-te-dropdown-menu-ref>

            <li>
              <a
                  class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                  href=""
                  data-te-dropdown-item-ref
                  @click="onLogout"
              >
                Login out
              </a>
            </li>

          </ul>
        </div>

        <div v-else
             class="relative" data-te-dropdown-ref>
          <a
              class="hidden-arrow mr-4 flex items-center text-neutral-500 hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
              id="dropdownMenuButton1"
              role="button"
              data-te-dropdown-toggle-ref
              aria-expanded="false">
            <!-- Dropdown trigger icon -->
            <span class="[&>svg]:w-5">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-5 w-5">
              <path
                  fill-rule="evenodd"
                  d="M4 28q0 0.832 0.576 1.44t1.44 0.576h20q0.8 0 1.408-0.576t0.576-1.44q0-1.44-0.672-2.912t-1.76-2.624-2.496-2.144-2.88-1.504q1.76-1.088 2.784-2.912t1.024-3.904v-1.984q0-3.328-2.336-5.664t-5.664-2.336-5.664 2.336-2.336 5.664v1.984q0 2.112 1.024 3.904t2.784 2.912q-1.504 0.544-2.88 1.504t-2.496 2.144-1.76 2.624-0.672 2.912z"
                  clip-rule="evenodd"/>
            </svg>
          </span>

          </a>
          <ul
              class="absolute left-auto right-0 z-[1000] float-left m-0 mt-1 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
              aria-labelledby="dropdownMenuButton1"
              data-te-dropdown-menu-ref>
            <!-- First dropdown menu items -->
            <li>
              <router-link
                  class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                  to="login"
                  data-te-dropdown-item-ref
              >
                Login
              </router-link>
            </li>
            <!--<li>
            <router-link
                class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                to="login"
                data-te-dropdown-item-ref
            >
              Register
            </router-link>
          </li>-->
          </ul>
        </div>


      </div>
    </div>
  </nav>
</template>
<script>
import {computed, onMounted, reactive, ref} from "vue";
import {Collapse, Dropdown, initTE} from "tw-elements";
import {useStore} from "vuex";
import router from '../../router/index.js'

export default {

  setup() {

    const store = useStore()

    const state = reactive({
      isAuth: computed({
        get() {
          return store.getters["auth/GET_AUTHENTICATED"]
        }
      }),
      userData: computed({
        get() {
          return store.getters["auth/GET_USER"]
        }
      }),
    })

    const items = ref([])

    onMounted(() => {

      //store.dispatch('auth/FETCH_LOGOUT')

      initTE({Collapse, Dropdown});

      let item = {}
      let newSortItems = []

      router.getRoutes().forEach(function (value) {
        if (value.meta.position === 'topnav') {
          item = {
            path: value.path,
            name: value.name,
          }
          newSortItems[value.meta.order] = item
        }
      })

      newSortItems.forEach(function (item) {
        items.value.push(item)
      })
    });

    const onLogout = () => {
      store.dispatch('auth/FETCH_LOGOUT')
      router.push('/login')
    }

    return {
      state,
      items,
      onLogout
    }
  }
}
</script>