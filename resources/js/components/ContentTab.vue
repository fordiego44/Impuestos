<template>
  <div>
    <Tab v-for="order in orders" :key="order.id"></Tab>
  </div>
</template>

<script>
import Tab from "./Tab";
import { mapGetters } from "vuex";

export default {
  name: "ContentTab",
  components: {
    Tab,
  },
  computed: mapGetters({
    orders: "orders",
  }),
};
</script>

<style lang="">
</style>