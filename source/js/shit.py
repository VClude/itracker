import xml.etree.ElementTree as ET
import os

directory = 'data'

root = ET.Element('root')
for filename in os.listdir(directory):
 root.append(ET.parse(directory + '/' + filename).getroot())

tree = ET.ElementTree(root)

ET.dump(tree)

tree.write('result.xml',
           xml_declaration = True,
           encoding = 'utf-8',
           method = 'xml')
