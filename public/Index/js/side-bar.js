

    window.log = function (text) {
      console.log(text);
      
    };

    class TreeMenu {

      constructor($container) {
        this.$container = $container;
        $container.find("[level]").click(this.levelClickHandler.bind(this));
        var id = 0;
        $container.find("[level]").each(function (index, item) {
          let $item = $(item);
          $item.attr("data-treemenu-id", ++id);
          this.setOpen($item, false);
          if (parseInt($item.attr("level")) > 0) {
            this.hideItem($item);
          } else {
            this.showItem($item);
          }
        }.bind(this));
      }

      levelClickHandler(evt) {
        var $el = $(evt.currentTarget);

        if (this.isOpen($el)) {
          this.closeItem($el);
        } else {
          this.openItem($el);
        }

      }

      getElementTreeMenuId($el) {
        return $el.attr("data-treemenu-id");
      }

      getElementLevel($el) {
        return parseInt($el.attr("level"));
      }

      isOpen($el) {
        return $el.attr("data-treemenu-open") === "1";
      }

      setOpen($el, to) {
        log("set open: " + to);
        $el.attr("data-treemenu-open", to ? "1" : "0");
      }

      getGroup($el) {
        log("get group");
    //the group is every element that has a higher level than this one
    var firstElementLevel = this.getElementLevel($el);
    var group = [];

    this.$container.find("[level]").each(function (index, item) {
      let $item = $(item);

      if (!group.length) {
        //first item has not been passed in the loop
        if (this.getElementTreeMenuId($el) == this.getElementTreeMenuId($item)) {
          //the current item is the parent of the group
          group.push($item);
        }
        //stop this iteration of the loop
        return true;
      }
      //
      //if the level of the item equals or is lower then the initial level, 
      // we have reached the end of the group
      let level = parseInt($item.attr("level"));
      if (level <= firstElementLevel) return false;
      if (level == firstElementLevel + 1) group.push($item);
    }.bind(this));
    return group;
  }

  closeItem($el) {
    this.setOpen($el, false);
    this.getGroup($el).forEach(function ($item, index) {
      if (!index) return true;
      this.hideItem($item);

      //also close its children
      this.closeItem($item);
    }.bind(this));
  }

  openItem($el) {
    this.setOpen($el, true);
    this.getGroup($el).forEach(function ($item, index) {
      if (!index) return true;
      this.showItem($item);
    }.bind(this));
  }

  showItem($el) {
    $el.removeClass("closed");
    $el.addClass("opened");
  }

  hideItem($el) {
    $el.removeClass('opened');
    $el.addClass("closed");
  }}


  var menu = new TreeMenu($(".treemenu"));
