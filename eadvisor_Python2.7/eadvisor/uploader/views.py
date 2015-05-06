import subprocess, os
from django.shortcuts import render_to_response, redirect
from django.template import RequestContext
from django.http import HttpResponseRedirect
from django.core.urlresolvers import reverse

from uploader.models import Document
from uploader.forms import DocumentForm, TrackForm

import parser5
import treeInit
import createPDF

def form(request):
    # if the upload button is pressed
    if request.method == 'POST':
        form = DocumentForm(request.POST, request.FILES)
        if form.is_valid():
	    # save file
            newdoc = Document(docfile = request.FILES['docfile'])
            newdoc.save()
            subprocess.call('python pdfminer-20140328/tools/pdf2txt.py -o uploaded/TDA.txt uploaded/TDA.pdf', shell=True)
            parser5.main('uploaded/TDA.txt',3)
            treeInit.main(parser5.IP_list, parser5.TAKE_list)
            createPDF.main(parser5.STU_info, parser5.GE_list, parser5.GRAD_list)
            subprocess.call('dot graph.dot -Tpng -o uploader/static/graph.png', shell=True)
            subprocess.call('rm -r uploaded/*', shell=True)
            # redirect to home page
            return redirect('welcome')
	# else have the file upload form loaded		
    else:
        form = DocumentForm() 

    # load the file upload form
    return render_to_response(
        'form.html',
        {'form': form},
        context_instance=RequestContext(request)
    )

def welcome(request):
	return render_to_response('welcome.html')
	
def tree(request):
	return render_to_response('tree.html')
	
def ge(request):
	return render_to_response('ge.html',{'gelist':parser5.GE_list})

def unit(request):
	return render_to_response('unit.html',{'gelist':parser5.GE_list, 'unitlist':parser5.GRAD_list})

def save(request):
	return render_to_response('save.html')

def prnt(request):
	return render_to_response('print.html')

def email(request):
	return render_to_response('email.html')

def help(request):
	return render_to_response('help.html')

def courses(request):
	if "track" in request.POST:
		selected = request.POST["track"]
	else:
		selected = None
	form = TrackForm()
	return render_to_response('courses.html', {'form': form, 'selected': selected}, context_instance=RequestContext(request))
