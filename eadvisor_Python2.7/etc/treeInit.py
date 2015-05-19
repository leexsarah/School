#import root/eadvisor/uploader/parser5
#from parser3.0 import final_take

#IP = ['CPSC 471', 'CPSC 335', 'CPSC 362', 'CPSC 440']
#TAKE = ['CPSC 481']

import re
import csv

class Course:

	def __init__(self, ID, name):
		self.ID = ID
		self.name = name
		self.status = 'blue'
		self.parent = []
		self.child = []
		# Alternate course ID's
	
	def PrereqTaken(self):
		# Return true if the course does not have any prerequisites
		if self.parent is None:
			return true
		
		for course in self.parent:
			# If the status of one of the prerequisites is "not taken", then return false
			if course.status == 'red':
				return false
		return true
	
	def treeID(self):
		# Define the regular expression to extract the treeID format 
		idstruct = re.compile('\d\d\d[A-Z]?')
		# Search for the ID number in self.ID and save it to treeid
		treeid = re.search(idstruct, self.ID)	
		# If there is and A or B in the ID, then replce them with 1 or 2
		treeid = treeid.group(0).replace('A', '1').replace('B', '2')
		return treeid
	
######################################################################################
## A function that returns a course object from the courselist based on a course ID ##
######################################################################################		
def searchCourseByID(course, courselist):
	if course:
		for i in range(len(courselist)):
			if course in courselist[i].ID:
				return courselist[i]

######################################################################################
## A function that sets up the tree structure by looping through the child lists #####
######################################################################################
def treeSetUp(courselist):
	treestruct = "\n"
	for course in courselist:
		# check to see if child list is empty
		if  course.child:
			treestruct =  treestruct + course.treeID() + "  -> {"
			for i in course.child:
				# check to see if i is not None
				if i:
					treestruct = treestruct + i.treeID() + " "
			treestruct += "}\n"
	treestruct += "\n"
	return treestruct

######################################################################################
## Main code for initializing and creating the tree ##################################
######################################################################################

courselist = []

# Open the course list file
infile = open('courses.csv', 'rb')
lines = csv.reader(infile)

# Initialize the Courselist objects with ID and name
for row in lines:
	ID = row[0]
	name = row[1]
	courselist.append(Course(ID, name))

# Return back to the beginning of the file
infile.seek(0)

# Initialize the parent and child lists of the Courselist objects
for row in lines:
	# Get the course from the courselist
	course = searchCourseByID(row[0], courselist)
	if row[2] != '-1':
		for p in row[2].split('+'):
			course.parent.append(courselist[int(p)])
	# Assign the child list
	if row[3] != '-1':
		for c in row[3].split('+'):
			course.child.append(courselist[int(c)])

# Close course list file
infile.close()

# traverse In Progress list and update status
for y in IP:
	course = searchCourseByID(y, courselist)
	course.status = 'yellow'
	#if not course.PrereqTaken():
		# save error message

# traverse Take list and update status
for r in TAKE:
	course = searchCourseByID(r, courselist)
	course.status = 'red'

# Create the tree output code
shape = "shape = rect, "
style = "style = rounded, "

# Initialize children nodes for the tree
treestruct = treeSetUp(courselist)

# Create code for stylizing the tree nodes
output = ""
for i in courselist:
	output = output + "    " + i.treeID() + ' [label = "' + i.ID + '", ' + shape + style + " " + "color = " + i.status + "];\n"
	
output = output + '\n'

# Write out the tree code to the dot file
text_file = open("graph.dot", "w")
text_file.write("digraph titangraph {\n")
text_file.write(output)
text_file.write(treestruct)
text_file.write("}")
text_file.close()

