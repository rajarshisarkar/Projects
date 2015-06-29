/*
 * To run this code:
 * 1. javac -classpath ../lib/jcommon-1.0.23.jar:../lib/jfreechart-1.0.19.jar StatisticsYearwiseFieldwise.java
 * 2. java StatisticsYearwiseFieldwise
*/

import java.awt.BasicStroke;
import java.awt.BorderLayout;
import java.awt.Color;
import javax.swing.JPanel;
import javax.swing.JLabel;
import java.awt.Stroke;
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import org.jfree.chart.ChartFactory;
import org.jfree.chart.ChartPanel;
import org.jfree.chart.JFreeChart;
import org.jfree.chart.axis.NumberAxis;
import org.jfree.chart.axis.CategoryAxis;
import org.jfree.chart.plot.CategoryPlot;
import org.jfree.chart.plot.PlotOrientation;
import org.jfree.chart.renderer.category.LineAndShapeRenderer;
import org.jfree.data.category.CategoryDataset;
import org.jfree.data.category.DefaultCategoryDataset;
import org.jfree.ui.ApplicationFrame;
import org.jfree.ui.RefineryUtilities;
import org.jfree.chart.axis.CategoryLabelPositions;

public class StatisticsYearwiseFieldwise extends ApplicationFrame {

    int count = 0;
    int totalfieldcount = 0;
    private static final long serialVersionUID = 1L;

    public StatisticsYearwiseFieldwise(final String title) throws FileNotFoundException {
	super(title);
	final CategoryDataset dataset = createDataset();
	final JFreeChart chart = createChart(dataset);
	final ChartPanel chartPanel = new ChartPanel(chart);
	chartPanel.setPreferredSize(new java.awt.Dimension(1024, 768));
	this.add(chartPanel, BorderLayout.CENTER);
	JPanel customPanel = new JPanel();
	JLabel lbl = new JLabel("<html><h4>Total papers published in year [1960, 2009]: 711810<br>Total non unique fields: " + totalfieldcount
		+ "<br>Total unique fields: 24</h4></html>");
	customPanel.add(lbl);
	this.add(customPanel, BorderLayout.SOUTH);
    }

    private CategoryDataset createDataset() throws FileNotFoundException {
	DefaultCategoryDataset dataset = null;
	String sCurrentLine;
	BufferedReader br = null;
	br = new BufferedReader(new FileReader("../data/taggeddataset"));
	String[] fieldnames = { "databases", "artificial_intelligence", "programming_languages", "scientific_computing", "data_mining", "simulation", "algorithms_and_theory",
		"software_engineering", "hardware_and_architecture", "natural_language_and_speech", "world_wide_web", "information_retrieval", "human-computer_interaction",
		"networks_and_communications", "multimedia", "computer_education", "real_time_and_embedded_systems", "graphics", "security_and_privacy",
		"machine_learning_and_pattern_recognition", "bioinformatics_and_computational_biology", "distributed_and_parallel_computing", "operating_systems",
		"computer_vision" };
	int[][] fieldcount = new int[50][24];
	int i, j, f;
	//int min = 2016, max = 0;
	String dataentry = "";
	String processedstring, time;

	try {
	    boolean flag = false;
	    while ((sCurrentLine = br.readLine()) != null) {
		if (sCurrentLine.toString().contains("#*")) {
		    if (flag) {
			i = dataentry.indexOf("#t");
			f = dataentry.indexOf("#index");
			processedstring = dataentry.substring(i + 2, f);
			time = processedstring.substring(0, 4);
			processedstring = processedstring.substring(4, processedstring.length());
			String[] fields = processedstring.split("#f");
			// System.out.print(time + " ");
			for (i = 1; i < fields.length; i++) {
			    // System.out.print(fields[i] + " ");
			    for (j = 0; j < 24; j++) {
				if (fields[i].equals(fieldnames[j]))
				    fieldcount[Integer.parseInt(time) - 1960][j]++;
			    }
			}
			// System.out.println();

			dataentry = "";
		    }
		} else {
		    dataentry += sCurrentLine;
		}
		flag = true;
	    }
	    i = dataentry.indexOf("#t");
	    f = dataentry.indexOf("#index");
	    processedstring = dataentry.substring(i + 2, f);
	    time = processedstring.substring(0, 4);
	    processedstring = processedstring.substring(4, processedstring.length());
	    String[] fields = processedstring.split("#f");
	    // System.out.print(time + " ");
	    for (i = 1; i < fields.length; i++) {
		// System.out.print(fields[i] + " ");
		for (j = 0; j < 24; j++) {
		    if (fields[i].equals(fieldnames[j]))
			fieldcount[Integer.parseInt(time) - 1960][j]++;
		}
	    }
	    // System.out.println();

	    dataentry = "";

	    for (j = 0; j < 50; j++) {
		for (i = 0; i < 24; i++) {
		    System.out.println("Papers published in year " + (j + 1960) + " in " + fieldnames[i] + " field" + ": " + fieldcount[j][i]);
		    totalfieldcount += fieldcount[j][i];
		}
	    }

	} catch (IOException e) {
	    e.printStackTrace();
	} finally {
	    try {
		if (br != null)
		    br.close();
	    } catch (IOException ex) {
		ex.printStackTrace();
	    }
	}
	System.out.println("Total non unique fields: " + totalfieldcount);
	System.out.println("All unique fields: [databases, artificial_intelligence, programming_languages, "
		+ "scientific_computing, data_mining, simulation, algorithms_and_theory, software_engineering, "
		+ "hardware_and_architecture, natural_language_and_speech, world_wide_web, " + "information_retrieval, human-computer_interaction, networks_and_communications, "
		+ "multimedia, computer_education, real_time_and_embedded_systems, graphics, " + "security_and_privacy, machine_learning_and_pattern_recognition, "
		+ "bioinformatics_and_computational_biology, " + "distributed_and_parallel_computing, operating_systems, computer_vision]" + "\nTotal unique fields: 24");
	dataset = new DefaultCategoryDataset();

	for (j = 0; j < 50; j++) {
	    for (i = 0; i < 24; i++) {
		// System.out.println("Papers published in year " + (j + 1960) +
		// " in " + fieldnames[i] + " field" + ": " + fieldcount[j][i]);
		Integer k = new Integer(1960 + j);
		dataset.addValue(fieldcount[j][i], fieldnames[i], k.toString());
	    }
	}

	return dataset;
    }

    private JFreeChart createChart(final CategoryDataset dataset) {
	final JFreeChart chart = ChartFactory.createLineChart("No. of papers published in a particular field vs Year plot", // chart
		"Year", // domain(x-axis) axis label
		"No. of papers published in a particular field", // range(y-axis)
		// axis label
		dataset, // data
		PlotOrientation.VERTICAL, // orientation
		true, // include legend
		true, // tooltips
		false // urls
		);

	chart.setBackgroundPaint(Color.white);
	final CategoryPlot plot = (CategoryPlot) chart.getPlot();
	plot.setBackgroundPaint(new Color(0xffffe0));
	plot.setDomainGridlinesVisible(true);
	plot.setDomainGridlinePaint(Color.lightGray);
	plot.setRangeGridlinePaint(Color.lightGray);
	final CategoryAxis domainAxis = plot.getDomainAxis();
	domainAxis.setCategoryLabelPositions(CategoryLabelPositions.UP_90);
	final NumberAxis rangeAxis = (NumberAxis) plot.getRangeAxis();
	rangeAxis.setStandardTickUnits(NumberAxis.createIntegerTickUnits());
	rangeAxis.setAutoRangeIncludesZero(true);
	final LineAndShapeRenderer renderer = (LineAndShapeRenderer) plot.getRenderer();
	renderer.setBaseShapesFilled(true);
	renderer.setBaseShapesVisible(true);
	Stroke stroke = new BasicStroke(3f, BasicStroke.CAP_ROUND, BasicStroke.JOIN_BEVEL);
	renderer.setBaseOutlineStroke(stroke);

	return chart;
    }

    public static void main(final String[] args) throws FileNotFoundException {
	final StatisticsYearwiseFieldwise demo = new StatisticsYearwiseFieldwise("");
	demo.pack();
	RefineryUtilities.centerFrameOnScreen(demo);
	demo.setVisible(true);
    }
}
