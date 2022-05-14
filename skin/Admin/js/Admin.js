
var admin = {

	url : null,
	type : 'POST',
	contentType : 'application/x-www-form-urlencoded',
	data : {},
	processData : false,
	dataType : 'json',
	form : null,

	setUrl : function (url) 
	{
		this.url = url;
		return this;
	},

	getUrl : function () 
	{
		return this.url;
	},

	setType : function (type) 
	{
		this.type = type;
		return this;
	},

	getType : function () 
	{
		return this.type;
	},

	setContentType : function (contentType) 
	{
		this.contentType = contentType;
		return this;
	},

	getContentType : function () 
	{
		return this.contentType;
	},

	setData : function (data) 
	{
		this.data = data;
		return this;
	},

	getData : function () 
	{
		return this.data;
	},

	setDataType : function (datatype) 
	{
		this.datatype = datatype;
		return this;
	},

	getDataType : function () 
	{
		return this.datatype;
	},

	setForm : function (form) 
	{
		this.form = form;
		return this;
	},

	getForm : function () 
	{
		return this.form;
	},

	load : function () 
	{
		const self = this;
		//alert("in admin ........" + this.getUrl() );
		$.ajax({
			type : this.getType(),
			url : this.getUrl(),
			data : this.getData(),
			contentType : this.getContentType(),
			success : function(data)
			{
				console.log("successfully data loaded");
				console.log(data);
				self.manageElements(data.elements);
			},
			error : function(error)
			{
				console.log("error");
				console.log(error);
			},
			dataType : this.getDataType()
		});
	},

	manageElements : function (elements) 
	{
		console.log(elements);
		jQuery(elements).each(function(index, element)
		{
			console.log("inside...Manage....Elements");
			console.log(element.element);
			console.log(element.content);
			jQuery(element.element).html(element.content);
			if(element.addClass != undefined){
				jQuery(element.element).addClass(element.addClass);
			}
		});
	},

	prepareFormParams : function()
	{
		this.setUrl(jQuery("#edit-form").attr('action'));
		this.setType(jQuery("#edit-form").attr('method'));
		this.setData(jQuery("#edit-form").serializeArray());
		return this;
	},

	paginationAction : function()
	{
		this.setUrl(jQuery("#pagination-form").attr('action'));
		this.setType(jQuery("#pagination-form").attr('method'));
		this.setData(jQuery("#pagination-form").serializeArray());
		return this;
	}

	
};

