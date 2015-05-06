from reportlab.lib.enums import TA_JUSTIFY
from reportlab.lib.pagesizes import letter
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, Image
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.lib.units import inch

def main(STU_info, GE_list, GRAD_list):
	doc = SimpleDocTemplate("Info.pdf",pagesize=letter,
	                        rightMargin=72,leftMargin=72,
	                        topMargin=72,bottomMargin=18)
	
	Story = []
	styles=getSampleStyleSheet()
	styles.add(ParagraphStyle(name='Justify', alignment = TA_JUSTIFY))
	pic = "/root/eadvisor/uploader/static/e-advisor1.2.png"
	tree = "/root/eadvisor/uploader/static/graph.png"
	im = Image(pic, 3.5*inch, 3*inch)
#	Story.append(im)
#	Story.append(Paragraph(STU_info[1], styles["Normal"]))
#	Story.append(Paragraph(STU_info[0], styles["Normal"]))
#	Story.append(Paragraph(STU_info[2], styles["Normal"]))
#	Story.append(Spacer(1, 50))
	ptext = '<font size=20>%s</font>' % "Core Major Classes and Prerequisites"
	Story.append(Paragraph(ptext, styles["Normal"]))
#	Story.append(Spacer(7, 12))
	im = Image(tree, 6*inch, 3*inch)
#	Story.append(im)
#	Story.append(Spacer(1, 50))
	
	ptext = '<font size=20>%s</font>' % "General Education Classes"
#	Story.append(Paragraph(ptext, styles["Normal"]))
#	Story.append(Spacer(7, 12))
	
	ge = ["A.1 ORAL COMMUNICATION","A.2 WRITTEN COMMUNICATION","A.3 CRITICAL THINKING","B.1 PHYSICAL SCIENCE","B.2 LIFE SCIENCE","B.3 LABORATORY EXPERIENCE","B.4 MATHEMATICS","B.5 IMPLICATIONS AND EXPLORATIONS","C.1 INTRODUCTION TO ARTS","C.2 INTRODUCTION TO HUMANITIES","C.3 EXPLORATIONS IN THE ARTS","C.4 ORIGINS OF WORLD","D.1 INTRODUCTION TO THE SOCIAL SCIENCES","D.2 WORLD CIVILIZATIONS AND CULTURES","D.3 AMERICAN HISTORY","D.4 AMERICAN GOVERNMENT","D.5 EXPLORATIONS IN SOCIAL SCIENCES","E. LIFELONG LEARNING","Z. CULTURAL DIVERSITY"]
	
#	for i in range(len(ge)):
#		Story.append(Paragraph(ge[i]+'\t'+GE_list[i], styles["Normal"]))

        ptext = '<font size=20>%s</font>' % "Units Requirements for Graduation"
#        Story.append(Paragraph(ptext, styles["Normal"]))
#        Story.append(Spacer(7, 12))

	unit = "GENERAL EDUCATION RESIDENCE UNIT" +  GE_list[23][0] + GE_list[23][1] 
	doc.build(Story)

