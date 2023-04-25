<template>

  <div>
    <label
        :class="form.classTitle"
        for="color"
    >
      {{ form.labelTitle }}
    </label
    >

    <div v-for="item in form.items" :key="item.value">

      <div
          :class="form.classItemWrapper"
      >
        <input
            :name="form.name"
            type="radio"
            :class="form.classItem"
            :value="item.value"
            checked=""
        />
        <label
            :class="form.classLabelItem"
            :for="item.value"
        >
          {{ item.label }}
        </label>
      </div>

      <br>

    </div>

  </div>

</template>
<script>

export default {
  props: {
    form: {
      classTitle: {},
      labelTitle: {},

      classItemWrapper: {},
      classItem: {},
      classLabelItem: {},

      name: {},

      items: [],
    }
  },
  setup() {

    return {}

  }
}
</script>