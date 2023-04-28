<template>
  <nav aria-label="Page navigation example">
    <ul class="list-style-none flex">
      <li>
        <a
            :class="pgStyles.pgLinkClass"
            :href="pg.first"
        >
          {{ '<<' }}
        </a>
      </li>
      <li>
        <a
            :class="pgStyles.pgLinkClass"
            href="#"
        >
          {{ '<' }}
        </a>
      </li>

      <li>
        <a
            :class="pgStyles.pgLinkClass"
            href="#"
        >
          1
        </a>
      </li>

      <li>
        <a
            :class="pgStyles.pgLinkClass"
            href="#"
        >
          {{ '>' }}
        </a>
      </li>

      <li>
        <a
            :class="pgStyles.pgLinkClass"
            :href="pg.last"
        >
          {{ '>>' }}
        </a>
      </li>

    </ul>

  </nav>
</template>
<script>
import {computed, onMounted, reactive, ref} from "vue";

export default {
  components: {},

  props: {
    pagination: {
      perPage: {
        type: Number,
        default: 15
      },
      currentPage: {
        type: Number,
        default: 1
      },
      path: {
        type: String,
        default: 'http://127.0.0.1:8097/api/v1/posts?page=1'
      },
      pageName: {
        type: String,
        default: 'page'
      },
      total: {
        type: Number,
        default: 1
      },
      lastPage: {
        type: Number,
        default: 1
      },
    }
  },
  setup(props) {

    /*{
      "perPage": 15,
        "currentPage": 1,
        "path": "http://127.0.0.1:8097/api/v1/posts",
        "pageName": "page",
        "total": 262,
        "lastPage": 18
    }*/

    //const pg = ref({})
    const pg = computed(() => {
      return {
        first: props.pagination.path,
        last: props.pagination.path + '?' + props.pagination.pageName + '=' + props.pagination.lastPage,
        prev: props.pagination.currentPage === 1 ? '' : parseInt(props.pagination.currentPage) - 1,
        next: props.pagination.currentPage === props.pagination.lastPage ? '' : parseInt(props.pagination.props.pagination.lastPage) + 1,
      }
    })

    /*const paginationProcess = () => {
      pg.value = {
        perPage: props.pagination.perPage,
        currentPage: props.pagination.currentPage,
        path: props.pagination.path,
        pageName: props.pagination.pageName,
        total: props.pagination.total,
        lastPage: props.pagination.lastPage,

        first: getPageLink('first'),
        last: getPageLink('last'),
        prev: getPageLink('prev'),
        next: getPageLink('next'),
      }
    }*/

    const getPageLink = (page) => {
      let link = '';
      let pageLink = '';
      switch (page) {
        case 'first':
          link = props.pagination.path
          break;
        case 'last':
          link = props.pagination.path + '?' + props.pagination.pageName + '=' + props.pagination.lastPage
          break;
        case 'prev':
          pageLink = props.pagination.currentPage === 1 ? '' : parseInt(props.pagination.currentPage) - 1;
          link = props.pagination.path + '?' + props.pagination.pageName + '=' + pageLink
          break;
        case 'next':
          pageLink = props.pagination.currentPage === props.pagination.lastPage ? '' : parseInt(props.pagination.props.pagination.lastPage) + 1;
          link = props.pagination.path + '?' + props.pagination.pageName + '=' + pageLink
          break;
      }
      return link;
    }

    onMounted(() => {
      console.log('uiPagination.onMounted');
      //console.log(props.pagination.perPage);

      /*pg.value = props.pagination
      console.log(props.pagination);*/

      //pg.value = props.pagination
      //console.log(props.pagination);

      /*let pgData = {
        perPage: props.pagination.perPage,
        currentPage: props.pagination.currentPage,
        path: props.pagination.path,
        pageName: props.pagination.pageName,
        total: props.pagination.total,
        lastPage: props.pagination.lastPage,

        first: getPageLink('first'),
        last: getPageLink('last'),
        prev: getPageLink('prev'),
        next: getPageLink('next'),
      }

      console.log(pgData)*/

      /*pg.value = {
        perPage: props.pagination.perPage,
        currentPage: props.pagination.currentPage,
        path: props.pagination.path,
        pageName: props.pagination.pageName,
        total: props.pagination.total,
        lastPage: props.pagination.lastPage,

        first: getPageLink('first'),
        last: getPageLink('last'),
        prev: getPageLink('prev'),
        next: getPageLink('next'),
      }

      console.log('pg.value')
      console.log(pg.value)*/

    })

    const pgStyles = ref({
      pgLinkClass: 'relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white',
    })

    return {
      pg,
      pgStyles
    }
  }
}
</script>
