from django.conf.urls import patterns, url

urlpatterns = patterns('uploader.views',
        url(r'^$', 'form', name='form'),
	url(r'^help', 'help', name='help'),
	url(r'^tree', 'tree', name='tree'),
	url(r'^ge', 'ge', name='ge'),
	url(r'^unit', 'unit', name='unit'),
	url(r'^save', 'save', name='save'),
	url(r'^print', 'prnt', name='prnt'),
	url(r'^email', 'email', name='email'),
	url(r'^welcome', 'welcome', name='welcome'),
	url(r'^courses', 'courses', name='courses'),
)