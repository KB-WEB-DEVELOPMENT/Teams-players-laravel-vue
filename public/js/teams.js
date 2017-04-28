
Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
  el :'#manage-vue',
  data :{
    teams: [],
	pagination: {
      total: 0,
      per_page: 2,
      from: 1,
      to: 0,
      current_page: 1
    },
    offset: 4,
    formErrors:{},
    formErrorsUpdate:{},
    newTeam : { 'name'},
    fillTeam : {'name'}
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + (this.offset * 2);
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  ready: function() {
    this.getVueItems(this.pagination.current_page);
  },
  methods: {
    getVueTeams: function(page) {
      this.$http.get('/teamsvueitems?page='+page).then((response) => {
        this.$set('teams', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    createTeam: function() {
      var input = this.newTeam;
      this.$http.post('/teamsvueitems',input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newTeam = {'name'};
        $("#create-team").modal('hide');
        toastr.success('Team Created Successfully.', 'Success Alert', {timeOut: 5000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    deleteTeam: function(team) {
      this.$http.delete('/teamsvueitems/'+ team.id).then((response) => {
        this.changePage(this.pagination.current_page);
        toastr.success('Post Deleted Successfully.', 'Success Alert', {timeOut: 5000});
      });
    },
    editTeam: function(team) {
      this.fillTeam.name = team.name;
      $("#edit-team").modal('show');
    },
    updateTeam: function(id) {
      var input = this.fillTeam;
      this.$http.put('/teamsvueitems/'+id,input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newTeam = {'name'};
        $("#edit-team").modal('hide');
        toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getVueTeams(page);
    }
  }
});
