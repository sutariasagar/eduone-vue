<template>
  <div class="btn-group">
    {{ title }}
    <!--<b-dropdown id="ddown-left" class="dropdown cui-topbar-avatar-dropdown">-->
      <!--<template slot="button-content" class="dropdown-toggle">-->

        <!--<a href="javascript:;" data-toggle="dropdown">-->
          <!--<i class="fa fa-filter" :class="{ 'text-muted': !keyword }"></i>-->
        <!--</a>-->

      <!--</template>-->
      <!--<b-dropdown-item href="#">-->
        <!--<template>-->

          <!--<div class="input-group input-group-sm">
            <input type="search" class="form-control" ref="input"
                   v-model="keyword" @keydown.enter="search" :placeholder="`Search ${field}...`">
            <span class="input-group-btn">
              <button class="btn btn-default fa fa-search" @click="search"></button>
            </span>
          </div>-->

        <!--</template>-->
      <!--</b-dropdown-item>-->


    <!--</b-dropdown>-->

    <b-dropdown id="ddown-form" text="" ref="ddown"  class="custom-filter" variant="link" no-caret>
        <template slot="button-content"><i class="fa fa-filter"></i><span class="sr-only">Search</span></template>
      <div class="input-group input-group-sm">
        <input type="search" class="form-control ml-1" ref="input"
               v-model="keyword" @keydown.enter="search" :placeholder="`Search ${field}...`">
        <span class="input-group-btn">
              <button class="btn btn-default fa fa-search custom-background mr-2 ml-1" @click="search"></button>
            </span>
      </div>
      <!--<input size="sm" class="form-input" v-model="keyword" @keydown.enter="search" :placeholder="`Search ${field}...`"/>-->
    </b-dropdown>
  </div>
</template>
<script>
    export default {
        props: ['field', 'title', 'query'],
        data: () => ({
            keyword: ''
        }),
        mounted () {
            $(this.$el).on('show', e => this.$refs.input.focus())
        },
        watch: {
            keyword (kw) {
                // reset immediately if empty
                if (kw === '') this.search()
            }
        },
        methods: {
            search () {
                const { query } = this
                // `$props.query` would be initialized to `{ limit: 10, offset: 0, sort: '', order: '' }` by default
                // custom query conditions must be set to observable by using `Vue.set / $vm.$set`
                this.$set(query, this.field, this.keyword)
                query.offset = 0 // reset pagination
            },

        }
    }
</script>
<style scoped>
  input[type=search]::-webkit-search-cancel-button {
    -webkit-appearance: searchfield-cancel-button;
    cursor: pointer;
  }

  .custom-background{
    background-color: transparent !important;
    border: none;
    color: #4949e3 !important;
  }
</style>
