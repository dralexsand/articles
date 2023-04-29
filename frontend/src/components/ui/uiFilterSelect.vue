<template>

  <label
      class="block">

    <label>Author:</label>
    <select
        @change="onChange"
        v-model="selected"
        data-te-select-init data-te-select-filter="true"
    >
      <option value="0">Select author...</option>
      <option
          v-for="author in authors"
          :key="author.id"
          :value="author.id">
        {{ author.author }}
      </option>
    </select>

  </label>

  <hr>

</template>
<script>

import {onMounted, ref} from "vue";
import {Select, initTE, Input, Datepicker} from "tw-elements";

export default {
  props: {
    authors: {}
  },
  emits: [
    'handleFilterSelect'
  ],
  setup(props, {emit}) {

    onMounted(() => {
      initTE({Select, Input, Datepicker});
    });

    const selected = ref({});
    const formValue = ref(false);
    const formValueSearch = ref('');

    const onChange = (value) => {
      //console.log(selected.value)
      emit('handleFilterSelect', {
        name: 'author_id',
        value: selected.value
      })
    }

    return {
      formValue,
      formValueSearch,
      onChange,
      selected
    }

  }
}
</script>
<style scoped>
.block {
  padding: 5px;
}

.block input {
  padding-left: 2px;
}

.block span {

}


label {

}
</style>